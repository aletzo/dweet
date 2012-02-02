<p>Attention! These dweets belong to <strong><?php echo $user->name ?></strong>!</p>

<textarea id="post" placeholder="say something"></textarea>
<div id="textarea_footer">
    <a href="#" id="post_submit">say!</a>
    <span id="characters"><em>160</em> <span id="characters_keyword">characters</span> left</span>
</div>

<div id="posts">
    <?php if ($posts = $user->getPosts()) : //it's an assignment not a comparison ?>
        <?php foreach ($posts as $post) : ?>
            <div class="post">
                <div class="author"><?php echo $post->getUser()->name ?> <span><?php echo $post->created_at ?></span></div>

                <div class="text"><?php echo $post->text?></div>
                <a href="#" class="reply" rel="<?php echo $post->id ?>">reply</a>
            </div>
            <?php if ($comments = $post->getComments()) : //it's an assignment not a comparison ?>
                <?php foreach ($comments as $comment) : ?>
                    <div class="comment">
                        <div class="author"><?php echo $comment->getUser()->name ?> <span><?php echo $comment->created_at ?></span></div>
                        <div class="text"><?php echo $comment->text ?></div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        <?php endforeach ?>
    <?php endif ?>
</div>

<div id="dialog-form" title="Reply to post">
	<form>
	    <p id="comment_characters"><em>160</em> characters left</p>
	    <p class="validate_tips"></p>
	    <fieldset>
	        <textarea name="reply" id="reply_textarea" placeholder="What do you have to say about that?"></textarea>
	    </fieldset>
	</form>
</div>

