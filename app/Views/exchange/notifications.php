    

<?= $this->section('js') ?>
<script src="<?php echo assets_url('admin') ?>/js/notifications.js"></script>


<script>

     

    var datatoload= { "<?= csrf_token() ?>" : "<?= csrf_hash() ?>" , "id": ""};  
    update_notifications(datatoload) 

    setInterval(getMsgInterval, <?php echo  setting("update_msg_interval"); ?>);

    function getMsgInterval() {
        update_notifications(datatoload)
    }

 

</script>

<?= $this->endSection('js') ?>