<?php
function isAdmin($userID)
{
    $sql = 'SELECT role FROM users WHERE id='.$userID .' AND role=1';
    $result = DB::query($sql);
    if(isset($result[0]['role']) && $result[0]['role'] == 1){
        return true;
    }else {
        return false;
    }
} 
//var_dump($_SESSION);
    //delete comment ˘˘

function showEditHTML($comment, $isReplyTrueFalse){
/* var_dump($comment);
var_dump($createdOn); */

?>

    <div class="col-md-9 personal-info">
    <div class="alert alert-info alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
        <i class="fas fa-exclamation-triangle"></i>
        Prosím uživatele, aby vyplnil <strong>políčko</strong>.
    </div>
    <h3>Komentář</h3>
    <form class="form-horizontal" action="index.php?page=editRemoveComment&commentID=<?php echo($_GET['commentID']) ?>&userID=<?php echo($_GET['userID']) ?>&isReplyTrueFalse=<?php echo($isReplyTrueFalse) ?>" role="form" method="post">
        <!-- komentář -->
        <div class="form-group">
            <div class="col-lg-8">

                <textarea name="comment" class="form-control" id="comment" rows="3"><?php echo($comment['comment']) ?></textarea>
            </div>
        </div>
        <!-- tlacitka -->
        <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
                <input name="update" type="submit" class="btn btn-outline-success" value="Uložit změny">
                <a href="index.php?page=post&post=<?php echo($comment['postID']) ?>" class="btn btn-outline-danger" value="Zrušit">Zrušit</a>
            </div>
        </div>
    </form>
</div>
<?php
}




if(isset($_SESSION['id'])){
    if($_SESSION['id'] == $_GET['userID'] || isAdmin($_SESSION['id'])){
        if(isset($_POST['update'])){
                
            if($_GET['isReplyTrueFalse'] == 'false' ){
                //comment
                $sql = 'SELECT postID FROM comments WHERE id='.$_GET['commentID'];
                $comment = DB::query($sql)[0];
                $sql = 'UPDATE comments SET comment="'. $_POST['comment'] .'" WHERE id=' . $_GET['commentID'].(isAdmin($_GET['userID'])?'':' AND userID='. $_SESSION['id']);
                
            }else{
                //replies
                $sql = 'SELECT postID FROM replies WHERE id='.$_GET['commentID'];
                $comment = DB::query($sql)[0];
                $sql = 'UPDATE replies SET comment="'. $_POST['comment'] .'" WHERE id=' . $_GET['commentID'].(isAdmin($_GET['userID'])?'':' AND userID='. $_SESSION['id']);
            }
           // echo($sql);
            DB::query($sql);
            header("Refresh:0; url=index.php?page=post&post=$comment[postID]");
        }




        if(isset($_GET["editOrRemove"]) && $_GET["editOrRemove"] == "remove"){
            $commentID = (int)$_GET['commentID'];
            echo "spoustim delete";
            echo "<br>";
            
            
            if($_GET['isReplyTrueFalse'] == 'false' ){
                $sql = 'SELECT postID FROM comments WHERE id='.$commentID;
                $comment = DB::query($sql)[0];
                $sql = 'UPDATE comments SET comment="", userID=20 WHERE id=' . $_GET['commentID']. (isAdmin($_GET['userID'])?'':' AND userID='.$_SESSION['id']);
                $result = DB::query($sql);
                ?><script>window.location.replace("index.php?page=post&post=<?php echo($comment['postID']) ?>");</script><?php
            }else{
                $sql = 'SELECT postID FROM replies WHERE id='.$commentID;
                $comment = DB::query($sql)[0];
                $sql = 'UPDATE replies SET comment="", userID=20 WHERE id=' . $_GET['commentID']. (isAdmin($_GET['userID'])?'':' AND userID='.$_SESSION['id']);
                $result = DB::query($sql);
                ?><script>window.location.replace("index.php?page=post&post=<?php echo($comment['postID']) ?>");</script><?php
            }

        }
        //delete comment ^^


        //edit comment ˘˘
        if(isset($_GET["editOrRemove"]) && $_GET["editOrRemove"] == "edit"){
            $commentID = (int)$_GET['commentID'];
            //var_dump($_GET);
            echo "<br>";
            if($_GET['isReplyTrueFalse'] == 'false' ){
                $sql = 'SELECT comment, createdOn, postID FROM comments WHERE id='.$commentID.(isAdmin($_SESSION['id'])?'':' AND userID='.  $_SESSION['id']);
                $result = DB::query($sql);
                //if(())
                $comment = $result[0]['comment'];
                $createdOn = $result[0]['createdOn'];
                showEditHTML($result[0], "false");
            }else{
                $sql = 'SELECT comment AS comment, createdOn, postID FROM replies WHERE id='.$commentID.(isAdmin($_SESSION['id'])?'':' AND userID='.  $_SESSION['id']);
                $result = DB::query($sql);
                showEditHTML($result[0], "true");
            }
        }
        //edit comment ^^
    }else{
        header("Refresh:1; url=index.php");
        display_errors(["Ty nezbedníku"]);
    }
}else{
    header("Refresh:1; url=index.php");
    display_errors(["Ty nezbedníku"]);

    
}

/* ----------------------------------------------------------------------------------------------------- */





?>

