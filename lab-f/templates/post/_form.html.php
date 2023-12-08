<?php
    /** @var $post ?\App\Model\Post */
?>

<div class="form-group">
    <label for="name">Recipe title</label>
    <input type="text" id="subject" name="post[recipeName]" value="<?= $post ? $post->getRecipeName() : '' ?>">
</div>

<div class="form-group">
    <label for="recipeTime">Time to make</label>
    <input type="text" id="recipeTime" name="post[recipeTime]" value="<?= $post ? $post->getRecipeTime() : '' ?>">
</div>

<div class="form-group">
    <label for="content">Content</label>
    <textarea id="content" name="post[recipeDescription]"><?= $post? $post->getRecipeDescription() : '' ?></textarea>
</div>

<div class="form-group">
    <label></label>
    <input type="submit" value="Submit">
</div>
