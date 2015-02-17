<!--testeditor START-->
<script type="text/javascript" src="<?= base_url() ?>assets/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        relative_urls: false,
        selector: "textarea",
        theme: "modern",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons",
        image_advtab: true,
        templates: [
            {title: 'Test template 1', content: 'Test 1'},
            {title: 'Test template 2', content: 'Test 2'}
        ]
    });

</script>
<!--text editor end-->

<style>
    li {
        display: list-item;
        text-align: -webkit-match-parent;
    }
</style>


<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">Post a new message</h3>
    </div>
    <div class="box-body">
        <form role="form" id="new_message_form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="data[title]" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea name="data[content]" style="width:100%"></textarea>
            </div>

            <div>
                <input name="userfile[]" onchange="showSelectedFileList()" id="filesToUpload" type="file" multiple="" />
                <p>
                    <strong>Files You Selected:</strong>
                </p>
                <ul id="fileList"><li>No Files Selected</li></ul>
            </div>

            <div id="userCheckList" class="form-group">
                <label>Select User</label>

                <?php
                foreach ($data as $rows) {
                    ?>
                    <div class="checkbox">
                        <label>
                            <input name="data[users][]" value="<?= $rows["id"] ?>" type="checkbox"/>
                            <?= $rows["f_name"] ?> <?= $rows["l_name"] ?>
                        </label> 
                    </div>

                    <?php
                }
                ?>


            </div>

            <div class="form-group">
                <div>
                <input type="submit" value="Post" class="btn btn-primary " />
                </div>
            </div>



        </form>

    </div><!-- /.box-body -->
</div>