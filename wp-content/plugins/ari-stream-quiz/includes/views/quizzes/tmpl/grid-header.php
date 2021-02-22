<?php
$postfix = uniqid( '_hd', false );
?>
<tr class="grey lighten-5">
    <th class="manage-column select-column">
        <input type="checkbox" class="filled-in select-all-items chk-quiz" id="chkAllQuiz<?php echo $postfix; ?>" autocomplete="off" />
        <label for="chkAllQuiz<?php echo $postfix; ?>"> </label>
    </th>
    <th class="manage-column column-primary sortable<?php if ( 'quiz_title' == $order_by ): ?> sort sort-<?php echo strtolower( $order_dir ); ?><?php endif; ?>" data-sort-column="quiz_title" data-sort-dir="<?php echo 'quiz_title' == $order_by ? $order_dir : ''; ?>"><div class="column-wrapper"><?php _e( 'Title', 'ari-stream-quiz' ); ?></div></th>
    <th class="manage-column"><?php _e( 'Author', 'ari-stream-quiz' ); ?></th>
    <th class="manage-column sortable<?php if ( 'created' == $order_by ): ?> sort sort-<?php echo strtolower( $order_dir ); ?><?php endif; ?>" data-sort-column="created" data-sort-dir="<?php echo 'created' == $order_by ? $order_dir : ''; ?>"><div class="column-wrapper"><?php _e( 'Created on', 'ari-stream-quiz' ); ?></div></th>
    <th class="manage-column sortable<?php if ( 'modified' == $order_by ): ?> sort sort-<?php echo strtolower( $order_dir ); ?><?php endif; ?>" data-sort-column="modified" data-sort-dir="<?php echo 'modified' == $order_by ? $order_dir : ''; ?>"><div class="column-wrapper"><?php _e( 'Last update', 'ari-stream-quiz' ); ?></div></th>
    <th class="manage-column column-shortcode"><?php _e( 'Shortcode', 'ari-stream-quiz' ); ?></th>
</tr>