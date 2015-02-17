<aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        
                            
                        
                        <small><?=isset($this->title) ? $this->title : "" ?></small>
                    </h1>
                    <ol class="breadcrumb">
<!--                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Examples</a></li>
                        <li class="active">Blank page</li>-->
                        <?php
                        if(is_array($breadcrumbData)){
                           foreach($breadcrumbData as $sets){
                               echo "<li>";
                               if(is_array($sets)){
                                     $sets['url'] = isset($sets['url']) ? base_url().$sets['url'] : "#";
                                     $sets['label'] =  isset($sets['label']) ? $sets['label'] : "";
                                     $class = isset($sets['class']) ? "<i class= {$sets['class']}></i>" : "";
                                     echo "<a href='{$sets['url']}'>{$class}{$sets['label']}</a>" ; 
                                }else{
                                    echo "<a href='#'>{$sets}</a>"  ;
                                }
                            }
                            echo "</li>";
                               
                           } 
                        
                        ?>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div id="body">
