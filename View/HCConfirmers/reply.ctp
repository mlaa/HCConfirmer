<?php
/**
 * COmanage Registry HC Confirmer Reply View
 *
 * Portions licensed to the University Corporation for Advanced Internet
 * Development, Inc. ("UCAID") under one or more contributor license agreements.
 * See the NOTICE file distributed with this work for additional information
 * regarding copyright ownership.
 *
 * UCAID licenses this file to you under the Apache License, Version 2.0
 * (the "License"); you may not use this file except in compliance with the
 * License. You may obtain a copy of the License at:
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * @link          http://www.internet2.edu/comanage COmanage Project
 * @package       registry
 * @since         COmanage Registry v3.1.0
 * @license       Apache License, Version 2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 */
?>

<div id="container">
<?php if(!empty($invite)): ?>
<?php
  $params = array('title' => $current_enrollment_flow . ' enrollment');
  print $this->element("pageTitle", $params);
  
  $verifyEmail = !empty($invite['CoInvite']['email_address_id']);

//var_dump( APP  . "View" . DS . "CoInvites" . DS . "buttons.inc" );

if( $current_enrollment_flow !== 'HC' ) : ?>

<div class="enrollment_flow_msg">
<?php if( ! in_array( $societies_list[$current_enrollment_flow_id], $user_societies ) ) : ?>
<p><?php echo $current_enrollment_flow; ?> does not have this email on file as an active member</p>
<?php else : ?>
<p>We did find this email on file with <?php echo implode(', ', $user_societies); ?></p>
<?php endif; ?>
</div>
<?php include "buttons.inc"; ?>

<?php else: ?>

<?php if( in_array(false, $email_verify ) ) : ?>
<div class="invitation">
  <span class="invitation-text">
    <?php print _txt(($verifyEmail ? 'fd.ev.for' : 'fd.inv.for'),
      array(filter_var(generateCn($invitee['PrimaryName']),FILTER_SANITIZE_SPECIAL_CHARS))); ?>
  </span>

  <?php
     // Include the default confirmation buttons. This requires $invite and
     // $co_enrollment_flow to be set by the controller.
     include  "buttons.inc";
  ?>
</div> <!-- /.invitiation -->
<?php else : ?>

<div class="email_error">
  <p><?php echo $email_verify['message']; ?></p>
<?php 
include  "buttons.inc";
   /* print $this->Html->link(
      'Go to Login',
      'https://' . $email_verify['hc_domain'] . '/Shibboleth.sso/Login',
      array('class' => 'cancelbutton')
    );*/
?>
</div> <!-- /.email_error -->
<?php endif; 
endif;
 ?>
<div class="fields">

  <div class="modelbox">
    <div class="boxtitle">
      <span class="boxtitle-link">Name<span class="required">*</span></span>
    </div> <!-- /.boxtitle -->
    
    <div class="modelbox-data">

      <div class="modelbox-data-field">
        <div class="modelbox-data-label">Prefix</div> <!-- /.modelbox-data-label -->
        <div class="modelbox-data-value"><?php echo ( !empty( $invitee['PrimaryName']['suffix'] ) ) ? $invitee['PrimaryName']['honorific'] : '' ; ?></div> <!-- /.model-box-data-value -->
      </div> <!-- /.modelbox-data-field -->
      
      <div class="modelbox-data-field">
        <div class="modelbox-data-label">Given Name(s)</div> <!-- /.modelbox-data-label -->
        <div class="modelbox-data-value"><?php echo $invitee['PrimaryName']['given']; ?></div> <!-- /.model-box-data-value -->
      </div> <!-- /.modelbox-data-field -->
      
      <div class="modelbox-data-field">
        <div class="modelbox-data-label">Last Name</div> <!-- /.modelbox-data-label -->
        <div class="modelbox-data-value"><?php echo $invitee['PrimaryName']['family']; ?></div> <!-- /.model-box-data-value -->
      </div> <!-- /.modelbox-data-field -->
      
      <div class="modelbox-data-field">
        <div class="modelbox-data-label">Suffix</div> <!-- /.modelbox-data-label -->
        <div class="modelbox-data-value"><?php echo ( !empty( $invitee['PrimaryName']['suffix'] ) ) ? $invitee['PrimaryName']['suffix'] : '' ; ?></div> <!-- /.model-box-data-value -->
      </div> <!-- /.modelbox-data-field -->
      
    </div><!-- /.modelbox-data -->
  </div> <!-- /.modelbox -->

  <div class="modelbox">
    <div class="boxtitle">
      <span class="boxtitle-link">Email Address</span>
    </div> <!-- /.boxtitle -->

    <div class="modelbox-data">
      <div class="modelbox-data-label">Email</div> <!-- /.modelbox-data-label -->
      <div class="modelbox-data-value"><?php echo $invitee['CoInvite']['mail']; ?></div> <!-- /.modelbox-data-value -->
    </div> <!-- /.modelbox-data -->
  </div> <!-- /.modelbox -->

  <div class="modelbox">
    <div class="boxtitle">
      <span class="boxtitle-link">Organization</span>
    </div> <!-- /.boxtitle -->

    <div class="modelbox-data">
      <div class="modelbox-data-label">Organization</div> <!-- /.modelbox-data-label -->
      <div class="modelbox-data-value"><?php echo $invitee['CoPersonRole'][0]['o']; ?></div> <!-- /.modelbox-data-value -->
    </div> <!-- /.modelbox-data -->
  </div> <!-- /.modelbox -->

  <div class="modelbox">
    <div class="boxtitle">
      <span class="boxtitle-link">Title</span>
    </div> <!-- /.boxtitle -->

    <div class="modelbox-data">
      <div class="modelbox-data-label">Title</div> <!-- /.modelbox-data-label -->
      <div class="modelbox-data-value"><?php echo $invitee['CoPersonRole'][0]['title']; ?></div> <!-- /.modelbox-data-value -->
    </div> <!-- /.modelbox-data -->
  </div> <!-- /.modelbox -->
  
</div> <!-- /.fields -->


</div> <!-- /.container -->
<?php endif;
