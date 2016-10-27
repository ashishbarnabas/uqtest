<?php echo $this->Form->create('User'); ?>
<div class="row">
    <div class="col-sm-2">
        <h4 class="headings">Username :</h4>
    </div>
    <div class="col-sm-8">
        <h4><h4><?php echo $this->Form->input('User.username', array('label' => '')); ?></h4></h4>
    </div>
</div>

<div class="row">
    <div class="col-sm-2">
        <h4 class="headings">Password :</h4>
    </div>
    <div class="col-sm-8">
        <h4><h4><?php echo $this->Form->input('User.password', array('label' => '')); ?></h4></h4>
    </div>
</div>
<?php echo $this->Form->end(__('Login')); ?>
