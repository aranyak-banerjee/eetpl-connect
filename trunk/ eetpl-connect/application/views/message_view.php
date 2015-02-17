<?php
if (isset($_REQUEST["msgId"])) {
       $passedMsgId = trim($_REQUEST["msgId"]);
    ?>
<script>
    $(document).ready(function(){
        $("ul.todo-list li").each(function(i,v){
            if($(this).data("target")=='<?=$passedMsgId?>'){
                $(this).click();
            }
        });
    });
</script>
    
    <?php
}
?>
<div class="row col-md-12">
    <div class="col-md-5">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3 id="total_no_messages">

                </h3>
                <p>

                    Total number of Messages: <b> <?= $data["total"] ?> </b>
                </p>
            </div>
            <!--            <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>-->
        </div>
    </div><!-- ./col -->
    <div class="col-md-5">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3 id="total_no_un-read_messages">

                </h3>
                <p>
                    Total number of unread Messages <b class="unreadMsgCount"><?= $data["total_unread"] ?></b>
                </p>
            </div>
            <!--            <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>-->
        </div>
    </div><!-- ./col -->

    <div class="col-md-2">
        <a href="<?= base_url() ?>index.php/message/newMessage"> <input type="button" class="btn btn-success btn-lg" id="new_message_link" value="Post a new Message"/></a>
    </div>
</div>
<div class="row">
    <section class="col-md-4">

        <div class="box box-info">
            <div class="box-header" >
                <i class="fa fa-envelope"></i>
                <h3 class="box-title">Message</h3>
                <!-- tools box -->
                <!--                <div class="pull-right box-tools">
                                    <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
                                </div> /. tools -->
            </div>
            <div id="message_titles_holder" class="box-body">
                <!--List of messages-->
                <ul class="todo-list">
                    <?php
                    foreach ($data["messageList"] as $list) {
                        $class = $list->is_read == 0 ? "un_read_message_list" : "read_message_list";
                        ?>
                        <li onclick="showMessage(<?= $list->id ?>)" data-target ="<?= $list->id ?>" class="<?= $class ?>">
                            <span class="text"><?= $list->title ?></span>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <!--            <div class="box-footer clearfix">
                            <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
                        </div>-->
        </div>

    </section>
    <section class="col-md-8">

        <div class="box box-info">
            <div class="box-header " >
                <i class="fa fa-envelope"></i>
                <h3 class="box-title">Message Details</h3>

            </div>
            <div id="message_body_holder" class="box-body">
                <!--Message body and comments-->
                <div id="msg_view" class="col-md-12">
                    <div id="msg_view_title" class="col-md-12"></div>
                    <div id="msg_view_body" class="col-md-12"></div>
                    <div id="msg_view_files" class="col-md-12"></div>
                    <div id="comment_holder">

                    </div>
                </div>
                <div id="comment_box_holder" style="display:none"  class = "col-md-12">
                    <form id="commentForm" class="col-md-12">
                        <input type="hidden" name="message_id_for_comment" id="message_id_for_comment" value=""/>
                        <div class="col-md-9">
                            <textarea class="col-md-12" name="data[comment]" id="comment"></textarea>
                        </div>
                        <div class="col-md-1">
                            <input type="submit" value="Post Comment" class="btn btn-lg btn-success" />
                        </div>
                    </form>
                </div>
            </div>


        </div>

    </section>

</div>