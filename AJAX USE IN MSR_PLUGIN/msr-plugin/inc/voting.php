<?php

function msr_post_voting_callback() {

    global $wpdb;
    $table_votes = $wpdb->prefix . 'post_votes';

    $post_id   = intval($_POST['pid']);
    $user_id   = intval($_POST['uid']);
    $vote_type = sanitize_text_field($_POST['type']);

    if (!empty($post_id) && !empty($user_id)) {

        // Check if already voted
        $already_voted = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT vote_type FROM $table_votes WHERE post_id = %d AND user_id = %d",
                $post_id,
                $user_id
            )
        );

        if ($already_voted) {
            if ($already_voted === $vote_type) {
                wp_send_json_error(['message' => "You already $vote_type this post"]);
            } else {
                // Update existing vote
               $update = $wpdb->update(
                    $table_votes, // table name
                    array(
                        'vote_type' => $vote_type, // column to update
                    ),
                    array(
                        'post_id' => $post_id,
                        'user_id' => $user_id,
                    ),
                    array(
                        '%s', // value format (for vote_type)
                    ),
                    array(
                        '%d', // where post_id
                        '%d', // where user_id
                    )
                );


                if ($update !== false) {
                    wp_send_json_success(['message' => "Your vote has been changed to '$vote_type'"]);
                } else {
                    wp_send_json_error(['message' => 'Database update error: ' . $wpdb->last_error]);
                }
            }
        } else {
            // Insert new vote
            $insert = $wpdb->insert(
                $table_votes,
                [
                    'post_id'   => $post_id,
                    'user_id'   => $user_id,
                    'vote_type' => $vote_type,
                ],
                ['%d', '%d', '%s']
            );

            if ($insert) {
                wp_send_json_success(['message' => "Your $vote_type has been recorded"]);
            } else {
                wp_send_json_error(['message' => 'Database insert error: ' . $wpdb->last_error]);
            }
        }

    } else {
        wp_send_json_error(['message' => 'Invalid post or user ID']);
    }

    wp_die();
}

add_action('wp_ajax_msr_post_voting', 'msr_post_voting_callback');
