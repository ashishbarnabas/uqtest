<?php
/**
 * Created by PhpStorm.
 * User: ashishb
 * Date: 27/10/16
 * Time: 9:14 AM
 */

if($request_type == 'GET'){
    if(!empty($check_response)){ ?>
        <h3 class="headings">ID: <?php echo $check_response['Api']['id']; ?></h3>
        <br>
        <div class="row">
            <div class="col-sm-2">
                <h4 class="headings">Code :</h4>
            </div>
            <div class="col-sm-8">
                <h4><?php echo $check_response['Api']['code']; ?></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <h4 class="headings">Name :</h4>
            </div>
            <div class="col-sm-8">
                <h4><?php echo $check_response['Api']['name']; ?></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <h4 class="headings">Abbr :</h4>
            </div>
            <div class="col-sm-8">
                <h4><?php echo $check_response['Api']['abbr']; ?></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <h4 class="headings">URL :</h4>
            </div>
            <div class="col-sm-8">
                <h4><a href="<?php echo $check_response['Api']['url']; ?>" target="_blank"><?php echo $check_response['Api']['url']; ?></a></h4>
            </div>
        </div>

<?php

    } else {
        echo '<h2>No record which matches ID: '.$requested_id.' has been found. Please check the ID and try again.</h2>';
    }
} else {
    echo '<h2>Add new record :</h2>';
    echo $this->Form->create('Api', array('method' => 'post'));
    echo $this->Form->input('Api.id', array('type' => 'hidden')); ?>

    <div class="row">
        <div class="col-sm-2">
            <h4>Code :</h4>
        </div>
        <div class="col-sm-4">
            <h4><?php echo $this->Form->input('Api.code', array('label' => '')); ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <h4>Name :</h4>
        </div>
        <div class="col-sm-4">
            <h4><?php echo $this->Form->input('Api.name', array('label' => '')); ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <h4>Abbreviation :</h4>
        </div>
        <div class="col-sm-4">
            <h4><?php echo $this->Form->input('Api.abbr', array('label' => '')); ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <h4>URL :</h4>
        </div>
        <div class="col-sm-4">
            <h4><?php echo $this->Form->input('Api.url', array('label' => '')); ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <h4><?php echo $this->Form->end('Save', array('submit' => 'submit')); ?></h4>
        </div>
    </div>
<?php } ?>