// أول ما الصفحة تفتح
window.onload = function () {

    loadComments();
    loadProfile();

};



// ================= PROFILE =================

function loadProfile(){

    let username = document.getElementById("username").value;


    if(username!=""){

        document.getElementById("profileName").innerHTML = username;

    }

}


// تحديث بيانات البروفايل

function updateProfile(){


    let commentsCount =
    document.querySelectorAll(".comment").length;


    document.getElementById("commentCount").innerHTML =
    commentsCount;


    let likes =
    document.querySelectorAll(".likes");


    let totalLikes = 0;


    likes.forEach(item=>{

        totalLikes += parseInt(item.innerHTML);

    });



    document.getElementById("likeCount").innerHTML =
    totalLikes;


}




// ================= COMMENTS =================


// عرض التعليقات
function loadComments() {

    fetch("comments.php?action=get")

    .then(response => response.json())

    .then(data => {


        let output = "";


        data.forEach(comment => {


            output += `

            <div class="comment">


                <h3>${comment.username}</h3>


                <p>${comment.comment}</p>


                <small>${comment.created_at}</small>


                <br><br>



                <button onclick="editComment(${comment.id}, \`${comment.comment}\`)">
                    ✏️ Edit
                </button>



                <button onclick="deleteComment(${comment.id})">
                    🗑 Delete
                </button>



                <button class="likeBtn"
                onclick="likeComment(${comment.id},this)">
                    ❤️ Like
                </button>



                <span class="likes" id="likes-${comment.id}">
                    0
                </span>

                Likes


                <hr>


            </div>

            `;


        });



        document.getElementById("comments").innerHTML = output;



        // تحميل عدد اللايكات

        document.querySelectorAll(".likes").forEach(span=>{


            let id =
            span.id.split("-")[1];


            fetch("comments.php?action=getLikes&comment_id="+id)


            .then(res=>res.text())


            .then(data=>{


                span.innerHTML=data;


                updateProfile();


            });



        });


        updateProfile();


    });

}




// ================= ADD COMMENT =================


function addComment(){


    let username =
    document.getElementById("username").value;


    let comment =
    document.getElementById("comment").value;



    if(username=="" || comment==""){


        alert("Please fill all fields");

        return;

    }



    // تحديث اسم البروفايل

    document.getElementById("profileName")
    .innerHTML=username;



    let formData=new FormData();


    formData.append("username",username);

    formData.append("comment",comment);



    fetch("comments.php?action=add",{

        method:"POST",

        body:formData

    })

    .then(res=>res.text())

    .then(data=>{


        document.getElementById("comment").value="";


        loadComments();


    });


}




// ================= DELETE =================


function deleteComment(id){


    if(confirm("Delete this comment?")){


        fetch("comments.php?action=delete&id="+id)


        .then(res=>res.text())


        .then(data=>{


            loadComments();


        });


    }


}




// ================= EDIT =================


function editComment(id,oldComment){


    let newComment =
    prompt("Edit Comment",oldComment);



    if(newComment==null || newComment=="")
        return;



    let formData=new FormData();


    formData.append("id",id);

    formData.append("comment",newComment);



    fetch("comments.php?action=update",{


        method:"POST",

        body:formData


    })


    .then(res=>res.text())


    .then(data=>{


        loadComments();


    });


}





// ================= LIKE =================


function likeComment(id,btn){



    let username =
    document.getElementById("username").value;



    if(username==""){


        alert("Enter your name first");

        return;

    }



    let formData=new FormData();


    formData.append("comment_id",id);

    formData.append("username",username);



    fetch("comments.php?action=like",{


        method:"POST",

        body:formData


    })

    .then(res=>res.text())


    .then(data=>{



        if(data=="already"){


            alert("You already liked this comment.");

            return;


        }



        btn.nextElementSibling.innerHTML=data;


        updateProfile();


    });


}