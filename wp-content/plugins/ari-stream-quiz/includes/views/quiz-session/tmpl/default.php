<?php
use Ari_Stream_Quiz\Helpers\Helper as Helper;
use Ari_Stream_Quiz\Helpers\Settings as Settings;
use Ari\Wordpress\Helper as WP_Helper;

$quiz = $data['quiz'];
$hide_title = $data['hide_title'];
$column_count = $data['column_count'];
$inline_scripts = $data['inline_scripts'];
$quiz_data = $this->quiz_data;
$current_path = dirname( __FILE__ );
$prefix = $this->id();
$page_count = count( $quiz_data->pages );
$current_url = get_permalink();
$show_questions_oncomplete = Settings::get_option( 'show_questions_oncomplete' );
$is_trivia = ( ARISTREAMQUIZ_QUIZTYPE_TRIVIA == $quiz->quiz_type );
$twitter_content = $is_trivia ? Settings::get_option( 'share_trivia_twitter_content' ) : Settings::get_option( 'share_personality_twitter_content' );
$facebook_title = $is_trivia ? Settings::get_option( 'share_trivia_facebook_title' ) : Settings::get_option( 'share_personality_facebook_title' );
$facebook_content = $is_trivia ? Settings::get_option( 'share_trivia_facebook_content' ) : Settings::get_option( 'share_personality_facebook_content' );
$email_subject = $is_trivia ? Settings::get_option( 'share_trivia_email_subject' ) : Settings::get_option( 'share_personality_email_subject' );
$email_body = $is_trivia ? Settings::get_option( 'share_trivia_email_body' ) : Settings::get_option( 'share_personality_email_body' );
$support_shortcodes = $quiz->quiz_meta->shortcode;
$lazy_load = Settings::get_option( 'lazy_load' );
$img_tmpl = $current_path . '/image.php';
?>
<?php if ( $inline_scripts ): ?>
<script type="text/javascript"><?php foreach ( $this->script_vars as $var_name => $var_val ) : ?>window["<?php echo $var_name; ?>"] = <?php echo json_encode( $var_val ); ?>;<?php endforeach; ?></script>
<script type="text/javascript">window.ARI_SCRIPT_LOADER_CONFIG = window.ARI_SCRIPT_LOADER_CONFIG || [];window.ARI_SCRIPT_LOADER_CONFIG.push({'scripts':["<?php echo ARISTREAMQUIZ_ASSETS_URL ?>scroll_to/jquery.scrollTo.min.js?v=<?php echo ARISTREAMQUIZ_VERSION; ?>","<?php echo ARISTREAMQUIZ_ASSETS_URL ?>common/jquery.quiz.js?v=<?php echo ARISTREAMQUIZ_VERSION; ?>"]});</script>
<script src="<?php echo ARISTREAMQUIZ_ASSETS_URL; ?>common/script_loader.js" async></script>
<?php endif; ?>
<div id="<?php echo $prefix; ?>_container" class="ari-stream-quiz quiz-session-container quiz-<?php echo $quiz->quiz_id; ?><?php if ( ! $show_questions_oncomplete ): ?> hide-questions<?php endif; ?><?php if ( $quiz->start_immediately ): ?> view-quiz-session<?php if ( $lazy_load ): ?> quiz-loading<?php endif; ?><?php else: ?> view-quiz-intro<?php endif; ?>" data-id="<?php echo $prefix; ?>">
    <div class="quiz-intro">
        <?php
            if ( ! $hide_title ):
        ?>
        <h2 class="quiz-title"><?php echo $quiz->quiz_title; ?></h2>
        <?php
            endif;
        ?>
        <div class="quiz-description">
            <?php echo $support_shortcodes && $quiz->quiz_description ? WP_Helper::do_shortcode( $quiz->quiz_description ) : $quiz->quiz_description; ?>
        </div>

        <?php
            if ( ! $quiz->start_immediately ):
        ?>
        <div class="quiz-actions">
            <button class="button button-salmon button-start-quiz full-width"><?php _e( 'Start quiz', 'ari-stream-quiz' ); ?></button>
        </div>
        <?php
            endif;
        ?>
    </div>
    <a name="<?php echo $prefix; ?>_top" id="<?php echo $prefix; ?>_top"></a>

    <?php
        if ( $lazy_load ):
    ?>
        <div class="quiz-loading-pane" style="display:none;">
            <svg width="72px" height="72px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="uil-squares"><rect x="0" y="0" width="100" height="100" fill="none" class="bk"></rect><rect x="15" y="15" width="20" height="20" fill="#cec9c9" class="sq"><animate attributeName="fill" from="#cec9c9" to="#3c302e" repeatCount="indefinite" dur="1s" begin="0.0s" values="#3c302e;#3c302e;#cec9c9;#cec9c9" keyTimes="0;0.1;0.2;1"></animate></rect><rect x="40" y="15" width="20" height="20" fill="#cec9c9" class="sq"><animate attributeName="fill" from="#cec9c9" to="#3c302e" repeatCount="indefinite" dur="1s" begin="0.125s" values="#3c302e;#3c302e;#cec9c9;#cec9c9" keyTimes="0;0.1;0.2;1"></animate></rect><rect x="65" y="15" width="20" height="20" fill="#cec9c9" class="sq"><animate attributeName="fill" from="#cec9c9" to="#3c302e" repeatCount="indefinite" dur="1s" begin="0.25s" values="#3c302e;#3c302e;#cec9c9;#cec9c9" keyTimes="0;0.1;0.2;1"></animate></rect><rect x="15" y="40" width="20" height="20" fill="#cec9c9" class="sq"><animate attributeName="fill" from="#cec9c9" to="#3c302e" repeatCount="indefinite" dur="1s" begin="0.875s" values="#3c302e;#3c302e;#cec9c9;#cec9c9" keyTimes="0;0.1;0.2;1"></animate></rect><rect x="65" y="40" width="20" height="20" fill="#cec9c9" class="sq"><animate attributeName="fill" from="#cec9c9" to="#3c302e" repeatCount="indefinite" dur="1s" begin="0.375" values="#3c302e;#3c302e;#cec9c9;#cec9c9" keyTimes="0;0.1;0.2;1"></animate></rect><rect x="15" y="65" width="20" height="20" fill="#cec9c9" class="sq"><animate attributeName="fill" from="#cec9c9" to="#3c302e" repeatCount="indefinite" dur="1s" begin="0.75s" values="#3c302e;#3c302e;#cec9c9;#cec9c9" keyTimes="0;0.1;0.2;1"></animate></rect><rect x="40" y="65" width="20" height="20" fill="#cec9c9" class="sq"><animate attributeName="fill" from="#cec9c9" to="#3c302e" repeatCount="indefinite" dur="1s" begin="0.625s" values="#3c302e;#3c302e;#cec9c9;#cec9c9" keyTimes="0;0.1;0.2;1"></animate></rect><rect x="65" y="65" width="20" height="20" fill="#cec9c9" class="sq"><animate attributeName="fill" from="#cec9c9" to="#3c302e" repeatCount="indefinite" dur="1s" begin="0.5s" values="#3c302e;#3c302e;#cec9c9;#cec9c9" keyTimes="0;0.1;0.2;1"></animate></rect></svg>
        </div>
    <?php
        endif;
    ?>

    <?php
        $page_num = 0;
        $question_number = 1;
        foreach ( $quiz_data->pages as $page ):
    ?>
    <div class="quiz-page<?php if ($page_num == 0 && $quiz->start_immediately): ?> current<?php endif; ?>" id="<?php echo $prefix . '_page_' . $page_num; ?>" data-page="<?php echo $page_num; ?>">
        <?php
            foreach ( $page->questions as $question ):
                $has_answer_with_image = false;
                foreach ( $question->answers as $answer ) {
                    if ( $answer->image_id > 0 ) {
                        $has_answer_with_image = true;
                        break;
                    }
                }
        ?>
        <div class="quiz-question<?php if ( $has_answer_with_image ): ?> quiz-question-has-image-answer<?php endif; ?>" id="<?php echo $prefix . '_question_' . $question->question_id; ?>" data-question-id="<?php echo $question->question_id; ?>">
            <div class="quiz-question-title" data-question-index="<?php echo $question_number; ?>">
                <?php echo $support_shortcodes && strlen( $question->question_title ) > 0 ? WP_Helper::do_shortcode( $question->question_title ) : $question->question_title; ?>
            </div>
            <?php
                if ( $question->image_id ):
                    $image = $question->image;
            ?>
            <div class="quiz-question-image">
                <div class="quiz-question-image-holder">
                    <?php $this->show_template( $img_tmpl, array( 'image' => $image, 'lazy_load' => $lazy_load ) ); ?>
                </div>
            </div>
            <?php
                endif;
            ?>
            <div class="quiz-question-answers<?php if ( $column_count > 1 && $has_answer_with_image ): ?> answer-col-<?php echo $column_count; ?><?php endif; ?> clearfix" id="<?php echo $prefix . '_answers_' . $question->question_id; ?>">
            <?php
                foreach ( $question->answers as $answer ):
                    $ctrl_id = $prefix . '_answer_' . $answer->answer_id;
                    $ctrl_name = $prefix . '_answer_' . $question->question_id;
                    $has_image = $answer->image_id > 0;
            ?>
                    <div class="quiz-question-answer-holder">
                        <div class="quiz-question-answer" id="<?php echo $prefix . '_answercontainer_' . $answer->answer_id; ?>">
                            <?php
                                if ( $has_answer_with_image ):
                            ?>
                            <div class="quiz-question-answer-image">
                                <?php
                                    if ( $has_image ):
                                        $image = $answer->image;
                                ?>
								<div class="quiz-question-answer-image-wrapper">
                                    <div class="quiz-question-answer-image-holder">
                                        <?php $this->show_template( $img_tmpl, array( 'image' => $image, 'lazy_load' => $lazy_load ) ); ?>
                                    </div>
							    </div>
                                <?php
                                    endif;
                                ?>
                            </div>
                            <?php
                                endif;
                            ?>
                            <div class="quiz-question-answer-controls">
                                <input type="radio" class="ari-checkbox quiz-question-answer-ctrl" name="<?php echo $ctrl_name; ?>" id="<?php echo $ctrl_id; ?>" value="<?php echo $answer->answer_id; ?>" data-question-id="<?php echo $question->question_id; ?>" />
                                <label class="ari-checkbox-label quiz-question-answer-ctrl-lbl" for="<?php echo $ctrl_id; ?>"><?php echo strlen( $answer->answer_title ) > 0 ? ( $support_shortcodes ? WP_Helper::do_shortcode( $answer->answer_title ) : $answer->answer_title ) : '&nbsp;'; ?></label>
                            </div>
                        </div>
                    </div>
            <?php
                endforeach;
            ?>
            </div>

            <div id="<?php echo $prefix . '_question_status_' . $question->question_id; ?>" class="quiz-question-status quiz-section" style="display:none;">
                <div class="quiz-question-result"></div>
                <div class="quiz-question-explanation"></div>
            </div>
        </div>
        <?php
                ++$question_number;
            endforeach;
        ?>
    </div>
    <?php
            ++$page_num;
        endforeach;
    ?>
    <?php
        if ( $quiz->collect_data() ):
    ?>
    <div class="quiz-user-data quiz-section" id="<?php echo $prefix; ?>_user_data">
        <div class="quiz-label"><?php _e( 'Complete the form below to see results', 'ari-stream-quiz' ); ?></div>
        <div class="quiz-user-data-form">
            <?php
            if ( $quiz->collect_name ):
                ?>
                <div class="quiz-user-data-name data-row">
                    <label for="<?php echo $prefix . '_userdata_name'; ?>"><?php _e( 'Your name', 'ari-stream-quiz' ); ?> :</label>
                    <input type="text" id="<?php echo $prefix . '_userdata_name'; ?>" data-key="name" autocomplete="off" placeholder="<?php esc_attr_e( 'Enter your name', 'ari-stream-quiz' ); ?>" data-validation-message="<?php esc_attr_e( 'Enter your name', 'ari-stream-quiz' ); ?>" />
                </div>
            <?php
            endif;
            ?>
            <?php
            if ( $quiz->collect_email ):
                ?>
                <div class="quiz-user-data-email data-row">
                    <label for="<?php echo $prefix . '_userdata_email'; ?>"><?php _e( 'Your e-mail', 'ari-stream-quiz' ); ?> :</label>
                    <input type="text" id="<?php echo $prefix . '_userdata_email'; ?>" data-key="email" autocomplete="off" placeholder="<?php esc_attr_e( 'Enter your e-mail', 'ari-stream-quiz' ); ?>" data-validation-empty-message="<?php esc_attr_e( 'Enter your email', 'ari-stream-quiz' ); ?>" data-validation-message="<?php esc_attr_e( 'Enter correct email', 'ari-stream-quiz' ); ?>" />
                </div>
            <?php
            endif;
            ?>
        </div>
        <div class="quiz-actions">
            <button class="button button-blue full-width button-collect-data"><?php _e( 'Show results', 'ari-stream-quiz' ); ?></button>
            <?php
            if ( $quiz->collect_data_optional ):
                ?>
                <button class="button button-alge full-width button-skip-collect-data"><?php _e( 'Skip and Show results', 'ari-stream-quiz' ); ?></button>
            <?php
            endif;
            ?>
        </div>
    </div>
    <?php
        endif;
    ?>
    <div class="quiz-result quiz-section" id="<?php echo $prefix; ?>_result">
        <div class="quiz-result-template" id="<?php echo $prefix; ?>_result_template">
            <div class="quiz-title"><?php echo $quiz->quiz_title; ?></div>
            <div class="quiz-score"><?php echo Settings::get_option( 'share_trivia_title' ); ?></div>
            <div class="result-title">{{title}}</div>
            <div class="result-image {{image_class}}" data-image-credit="{{image_credit}}">{{image}}</div>
            <div class="result-content">{{content}}</div>
        </div>
        <div class="quiz-result-wrapper"></div>
        <?php
            if ( (bool)$quiz->quiz_meta->show_share_buttons && count( $this->share_buttons ) > 0 ):
        ?>
        <div class="quiz-result-share-buttons">
            <div class="share-title"><?php _e( 'Share your result via', 'ari-stream-quiz' ); ?></div>
            <div class="buttons-container">
                <?php
                    if ( in_array( 'facebook', $this->share_buttons ) ):
                ?>
                    <a href="https://www.facebook.com/sharer.php?u=<?php echo rawurlencode( $current_url ); ?>" class="button button-share button-facebook" target="_blank" data-share-title="<?php echo esc_attr( $facebook_title ); ?>" data-share-description="<?php echo esc_attr( $facebook_content ); ?>">
                        <i>
                            <svg version="1.1" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
                                <g>
                                    <path d="M18.768,7.465H14.5V5.56c0-0.896,0.594-1.105,1.012-1.105s2.988,0,2.988,0V0.513L14.171,0.5C10.244,0.5,9.5,3.438,9.5,5.32 v2.145h-3v4h3c0,5.212,0,12,0,12h5c0,0,0-6.85,0-12h3.851L18.768,7.465z"/>
                                </g>
                            </svg>
                        </i>
                        <span><?php _e( 'Facebook', 'ari-stream-quiz' ); ?></span>
                    </a>
                <?php
                    endif;
                ?>
                <?php
                    if ( in_array( 'twitter', $this->share_buttons ) ):
                ?>
                    <a href="#" class="button button-share button-twitter" data-share-url="https://twitter.com/intent/tweet?original_referer={{url}}&url={{url}}&text={{item_content}}" target="_blank" data-share-description="<?php echo esc_attr( $twitter_content ); ?>">
                        <i>
                            <svg version="1.1" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
                                <g>
                                    <path d="M23.444,4.834c-0.814,0.363-1.5,0.375-2.228,0.016c0.938-0.562,0.981-0.957,1.32-2.019c-0.878,0.521-1.851,0.9-2.886,1.104 C18.823,3.053,17.642,2.5,16.335,2.5c-2.51,0-4.544,2.036-4.544,4.544c0,0.356,0.04,0.703,0.117,1.036 C8.132,7.891,4.783,6.082,2.542,3.332C2.151,4.003,1.927,4.784,1.927,5.617c0,1.577,0.803,2.967,2.021,3.782 C3.203,9.375,2.503,9.171,1.891,8.831C1.89,8.85,1.89,8.868,1.89,8.888c0,2.202,1.566,4.038,3.646,4.456 c-0.666,0.181-1.368,0.209-2.053,0.079c0.579,1.804,2.257,3.118,4.245,3.155C5.783,18.102,3.372,18.737,1,18.459 C3.012,19.748,5.399,20.5,7.966,20.5c8.358,0,12.928-6.924,12.928-12.929c0-0.198-0.003-0.393-0.012-0.588 C21.769,6.343,22.835,5.746,23.444,4.834z"/>
                                </g>
                            </svg>
                        </i>
                        <span><?php _e( 'Twitter', 'ari-stream-quiz' ); ?></span>
                    </a>
                <?php
                    endif;
                ?>
                <?php
                    if ( in_array( 'gplus', $this->share_buttons ) ):
                ?>
                    <a href="#" class="button button-share button-gplus" data-share-url="https://plus.google.com/share?url={{url}}" target="_blank">
                        <i>
                            <svg version="1.1" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
                                <g>
                                    <path d="M11.366,12.928c-0.729-0.516-1.393-1.273-1.404-1.505c0-0.425,0.038-0.627,0.988-1.368 c1.229-0.962,1.906-2.228,1.906-3.564c0-1.212-0.37-2.289-1.001-3.044h0.488c0.102,0,0.2-0.033,0.282-0.091l1.364-0.989 c0.169-0.121,0.24-0.338,0.176-0.536C14.102,1.635,13.918,1.5,13.709,1.5H7.608c-0.667,0-1.345,0.118-2.011,0.347 c-2.225,0.766-3.778,2.66-3.778,4.605c0,2.755,2.134,4.845,4.987,4.91c-0.056,0.22-0.084,0.434-0.084,0.645 c0,0.425,0.108,0.827,0.33,1.216c-0.026,0-0.051,0-0.079,0c-2.72,0-5.175,1.334-6.107,3.32C0.623,17.06,0.5,17.582,0.5,18.098 c0,0.501,0.129,0.984,0.382,1.438c0.585,1.046,1.843,1.861,3.544,2.289c0.877,0.223,1.82,0.335,2.8,0.335 c0.88,0,1.718-0.114,2.494-0.338c2.419-0.702,3.981-2.482,3.981-4.538C13.701,15.312,13.068,14.132,11.366,12.928z M3.66,17.443 c0-1.435,1.823-2.693,3.899-2.693h0.057c0.451,0.005,0.892,0.072,1.309,0.2c0.142,0.098,0.28,0.192,0.412,0.282 c0.962,0.656,1.597,1.088,1.774,1.783c0.041,0.175,0.063,0.35,0.063,0.519c0,1.787-1.333,2.693-3.961,2.693 C5.221,20.225,3.66,19.002,3.66,17.443z M5.551,3.89c0.324-0.371,0.75-0.566,1.227-0.566l0.055,0 c1.349,0.041,2.639,1.543,2.876,3.349c0.133,1.013-0.092,1.964-0.601,2.544C8.782,9.589,8.363,9.783,7.866,9.783H7.865H7.844 c-1.321-0.04-2.639-1.6-2.875-3.405C4.836,5.37,5.049,4.462,5.551,3.89z"/>
                                    <polygon points="23.5,9.5 20.5,9.5 20.5,6.5 18.5,6.5 18.5,9.5 15.5,9.5 15.5,11.5 18.5,11.5 18.5,14.5 20.5,14.5 20.5,11.5  23.5,11.5 	"/>
                                </g>
                            </svg>
                        </i>
                        <span><?php _e( 'Google+', 'ari-stream-quiz' ); ?></span>
                    </a>
                <?php
                    endif;
                ?>
                <?php
                    if ( in_array( 'email', $this->share_buttons ) ):
                ?>
                    <a href="#" class="button button-share button-email" data-share-url="mailto:?body={{item_content}}&subject={{item_title}}" data-share-disable-modal="1" data-share-title="<?php echo esc_attr( $email_subject ); ?>" data-share-description="<?php echo esc_attr( $email_body ); ?>">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 3v18h24v-18h-24zm21.518 2l-9.518 7.713-9.518-7.713h19.036zm-19.518 14v-11.817l10 8.104 10-8.104v11.817h-20z"/></svg>
                        </i>
                        <span><?php _e( 'Email', 'ari-stream-quiz' ); ?></span>
                    </a>
                <?php
                    endif;
                ?>
            </div>
        </div>
        <?php
            endif;
        ?>
    </div>
</div>