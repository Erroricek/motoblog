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
$loggedIn = false;

if (isset($_SESSION['loged']) && isset($_SESSION['id'])) {
    $loggedIn = true;
}


function canIEditOrDeleteMyCommentQuestionMark($commentID, $userID, bool $isReplyTrueFalse) /* TODO */
{
    $intCommentID = (int)$commentID;
    if (isset($_SESSION['loged']) && isset($_SESSION['id']) && $userID == $_SESSION['id'] || isAdmin($_SESSION['id'])) {
        return  " " .   '<a href="index.php?page=editRemoveComment&editOrRemove=edit&commentID=' . $intCommentID . '&isReplyTrueFalse=' . ($isReplyTrueFalse ? "false" : "true") . '&userID=' . $userID . '"><i class="fas fa-edit vyplnena"></i></a>' . " " .
            '<a href="index.php?page=editRemoveComment&editOrRemove=remove&commentID=' . $intCommentID . '&isReplyTrueFalse=' . ($isReplyTrueFalse ? "false" : "true") . '&userID=' . $userID . '"><i class="fas fa-eraser vyplnena"></i></a>';
    } else {
        //echo 'někdo se snaží něčemu na co nemá právo...';
        return false;
    }
}


function createCommentRow($data, $showReplyButton)
{
    global $conn;
    $replyHTML = '<div class="reply"><a href="javascript:void(0)" data-commentID="' . $data['id'] . '" onclick="reply(this)">odpověď</a></div>';
    $data['comment'] = preg_replace('#<script(.*?)>(.*?)</script>#is', 'Jsem hnusnej hacker a chci hacknout tuto stránku.', $data['comment']);
    $response = '
            <div class="comment">
                <div class="user">' . $data['name'] . ' <span class="time">' . $data['createdOn'] . '</span>' . (isset($_SESSION['id'])?canIEditOrDeleteMyCommentQuestionMark((int)$data['id'], $_SESSION['id'], $showReplyButton):'') . '</div>
                <div class="userComment">' . ($data['comment'] != "" ? $data['comment'] : '<span class="text-muted"><h5> Komentář smazán. </h5></span>') . '</div>
                ' . ($showReplyButton ? $replyHTML : "");
    if ($showReplyButton) {
        $response .= '<div class="replies">';

        $sql = $conn->query("SELECT users.id AS userID, replies.id, firstName AS name, comment, DATE_FORMAT(replies.createdOn, '%d.%m.%Y %h:%i') AS createdOn FROM replies INNER JOIN users ON replies.userID = users.id WHERE postID = {$_POST["postID"]} AND replies.commentID = '" . $data['id'] . "' ORDER BY replies.id ASC");
        while ($dataR = $sql->fetch_assoc())
            $response .= createCommentRow($dataR, FALSE);


        $response .= '
                        </div>
            </div>
        ';
    } else {
        $response .= '
                        </div>
        ';
    }
    return $response;
}

if (isset($_POST['getAllComments'])) {
    $start = $conn->real_escape_string($_POST['start']);

    $response = "";
    $sql = $conn->query("SELECT users.id AS userID, comments.id, firstName AS name, comment, DATE_FORMAT(comments.createdOn, '%d.%m.%Y %h:%i') AS createdOn FROM comments INNER JOIN users ON comments.userID = users.id WHERE postID = {$_POST["postID"]} ORDER BY comments.createdON DESC LIMIT $start, 20");

    while ($data = $sql->fetch_assoc())
        $response .= createCommentRow($data, TRUE);

    exit($response);
}

if (isset($_POST['addComment'])) {
    $comment = $conn->real_escape_string($_POST['comment']);
    $isReply = $conn->real_escape_string($_POST['isReply']);
    $commentID = $conn->real_escape_string($_POST['commentID']);
    $postID = $conn->real_escape_string($_POST['postID']);

    if ($isReply != 'false') {
        $conn->query("INSERT INTO replies (comment, commentID, userID, createdOn, postID) VALUES ('$comment', '$commentID', '" . $_SESSION['id'] . "', NOW(), $postID)");

        $sql = $conn->query("SELECT users.id AS userID, replies.id, firstName AS name, comment, DATE_FORMAT(replies.createdOn, '%d.%m.%Y %h:%i') AS createdOn FROM replies INNER JOIN users ON replies.userID = users.id ORDER BY replies.id DESC LIMIT 1");
    } else {
        $sql_insert_comment = "INSERT INTO comments (userID, comment, createdOn, postID) VALUES ('" . $_SESSION['id'] . "','$comment',NOW(), $postID)";
        $result = $conn->query($sql_insert_comment);

        $sql = $conn->query("SELECT users.id AS userID, comments.id, firstName AS name, comment, DATE_FORMAT(comments.createdOn, '%d.%m.%Y %h:%i') AS createdOn FROM comments INNER JOIN users ON comments.userID = users.id WHERE postID=$postID ORDER BY comments.id DESC LIMIT 1");
    }
    $data = $sql->fetch_assoc();

    exit(createCommentRow($data, $_GET["isReply"] != "true" ? TRUE : FALSE));
}


$sqlNumComments = $conn->query("SELECT id FROM comments WHERE postID={$_GET["post"]}");
$numComments = $sqlNumComments->num_rows;
?>
<style type="text/css">
    .comment {
        margin-bottom: 20px;
    }

    .user {
        font-weight: bold;
        color: black;
    }

    .time,
    .reply {
        color: gray;
    }

    .userComment {
        color: #000;
    }

    .replies .comment {
        margin-top: 20px;

    }

    .replies {
        margin-left: 20px;
    }

    #registerModal input,
    #logInModal input {
        margin-top: 10px;
    }
</style>


<div>




    <div class="container" style="margin-top:50px;">
        <div class="row">
            <div class="col-md-12">
                <textarea class="form-control" id="mainComment" placeholder="přidej komentář" cols="30" rows="2"></textarea><br>
                <?php 
                if ($User){
                    echo('<button style="float:right" class="btn-primary btn" onclick="isReply = false;" id="addComment">Přidej komentář</button>');
                }else{
                    echo('<a href="/index.php?page=register" style="float:right" class="btn-danger btn">Registruj se</a>');
                    /* header("Refresh:0; url=index.php?page=register"); */
                }?>
                <button id="showHideCommentsDiv">Klikni pro zobrazení komentářů.</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2><b id="numComments"><?php echo $numComments ?> Komentářů</b></h2>
                <div id="showHideCommentsDiv">
                    <div class="userComments comments" style="display: none;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row replyRow" style="display:none">
        <div class="col-md-12">
            <textarea class="form-control" id="replyComment" placeholder="přidej komentář" cols="30" rows="2"></textarea><br>
            <button style="float:right" class="btn-primary btn" onclick="isReply = true;" id="addReply">přidej odpověď</button>
            <button style="float:right" class="btn-default btn" onclick="$('.replyRow').hide();">zavři</button>
        </div>
    </div>


    <script type="text/javascript">
        var isReply = false,
            commentID = 0,
            max = <?php echo $numComments ?>;

        $(document).ready(function() {
            $("#addComment, #addReply").on('click', function() {
                var comment;

                if (!isReply)
                    comment = $("#mainComment").val();
                else
                    comment = $("#replyComment").val();

                if (comment.length > 5) {
                    /*
                        <form action="layout/comments.php" method="POST">
                            <input name="addComment" value="1">
                            <!-- ... -->
                            <input type="submit" >
                        </form>

                        layout/comments.php >>> <?php $_POST['addComment'] ?>
                    */
                    $.ajax({
                        url: '?page=comments-ajax&isReply=' + isReply,

                        method: 'POST',
                        dataType: 'text',
                        data: {
                            addComment: 1,
                            comment: comment,
                            isReply: isReply,
                            commentID: commentID,
                            postID: <?php echo isset($_GET["post"]) ? $_GET["post"] : ""  ?>
                        },
                        success: function(response) {
                            if (!isReply) 
                                max++;
                            $("#numComments").text(max + " Komentářů");

                            if (!isReply) {
                                $(".userComments").prepend(response);
                                $("#mainComment").val("");
                            } else {
                                commentID = 0;
                                $("#replyComment").val("");
                                $(".replyRow").hide();
                                $('.replyRow').parent().next().append(response);
                            }
                        }
                    });
                } else
                    alert('Please Check Your Inputs');
            });

            getAllComments(0, max)


        });

        function reply(caller) {
            commentID = $(caller).attr('data-commentID');
            $(".replyRow").insertAfter($(caller));
            $('.replyRow').show();
        }

        function getAllComments(start, max) {
            if (start > max) {
                return;
            }

            $.ajax({
                url: '?page=comments-ajax',
                method: 'POST',
                dataType: 'text',
                data: {
                    getAllComments: 1,
                    start: start,
                    postID: <?php echo isset($_GET["post"]) ? $_GET["post"] : 0 ?>
                },
                success: function(response) {
                    $(".userComments").append(response);
                    getAllComments((start + 20), max);
                }
            });
        }



        $(document).ready(function() {
            $('#showHideCommentsDiv').click(function() {
                $('.comments').toggle("slide");
            });
        });
    </script>

</div>