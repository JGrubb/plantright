<?php

/**
 * @file block.tpl.php
 *
 * Theme implementation to display a block.
 *
 * Available variables:
 * - $block->subject: Block title.
 * - $block->content: Block content.
 * - $block->module: Module that generated the block.
 * - $block->delta: This is a numeric id connected to each module.
 * - $block->region: The block region embedding the current block.
 *
 * Helper variables:
 * - $block_zebra: Outputs 'odd' and 'even' dependent on each block region.
 * - $zebra: Same output as $block_zebra but independent of any block region.
 * - $block_id: Counter dependent on each block region.
 * - $id: Same output as $block_id but independent of any block region.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */
global $user;
$content = $block->content;
$total_invites = $content['total_invites'];
$ignored_invites = $content['ignored_invites'];
$accepted_invites = $content['accepted_invites'];
$invite_percentage = ($accepted_invites / $total_invites) * 100;
//dpm($user);
$invites_sent = $content['invites'] ? "complete" : "incomplete";
$invite_progress = ($invite_percentage == 100) ? "complete" : "incomplete";
$user_quiz_progress = in_array(11, array_keys($user->roles)) ? "complete" : "incomplete" ;
//$group_quiz_progress = (count($content['certified_buyers']) >= $content['total_buyers']) ? "complete" : "incomplete";

$group_quiz_progress = (count($content['certified_buyers']) >= $content['total_buyers']) ? "complete" : "incomplete";
?>
<div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="block block-<?php print $block->module ?>">
<?php if ($block->subject): ?>
  <h2><?php print $block->subject ?></h2>
<?php endif;?>

  <div id="progress-block" class="content">
    <h2>Becoming a PlantRight Partner</h2>
    <h3 id="the-checklist">The Checklist</h3>
    <p>This checklist shows your completed steps and what's still required to become a certified PlantRight Partner nursery.</p>

    <div id="register-account" class="item complete">
      <p class="desc">Create an account at PlantRight.org</p>
      <p class="status">Completed</p>
    </div>
    
    <div id="review-material" class="item <?php print $user_quiz_progress ?>">
      <p class="desc">Review the PlantRight 101 training materials</p>
      <?php if (in_array(11, array_keys($user->roles))): ?>
        <p class="status">Complete</p>
      <?php else : ?>
        <p class="status"><a href="/plantright-101-training">PlantRight 101 training page</a></p>
      <?php endif; ?>
    </div>

    <div id="take-quiz" class="item <?php print $user_quiz_progress ?>">
      <p class="desc">Pass our 10 question quiz</p>
      <?php if (in_array(11, array_keys($user->roles))): ?>
        <p class="status">Complete</p>
      <?php else : ?>
        <p class="status"><a href="/node/1421/take">Take the quiz</a></p>
      <?php endif; ?>
      
    </div>

    <div id="pass-quiz" class="item <?php print $group_quiz_progress ?>">
      <p class="desc">All plant buyers pass our 10 question quiz</p>
      <?php if ($content['total_buyers'] >= count($certified_buyers)): ?>
        <p class="status">Complete</p>
      <?php else : ?>
        <a href="#" class="dropdown-toggle">Your progress details</a>
        <div class="dropdown">
          <h4><?php print count($content['certified_buyers']) ?> of <?php print $content['total_buyers'] ?> are certified</h4>
        </div>
      <?php endif; ?>
    </div>

  </div>
</div>