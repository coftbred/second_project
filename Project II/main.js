console.log("script loaded");
// Get elements to be used
let searchinput = document.querySelector("input.search");
let ajaxoutputdiv = document.querySelector(".ajax-output");
let form = document.querySelector("form");
let theform = document.querySelector("form.comment-form");
let thecomment = document.querySelector(".comment-form textarea");
let hiddeninput = document.querySelector(".comment-form input");
let commentsdiv = document.querySelector(".comments");
let commentcard = document.querySelectorAll(".card");
// Event Listeners
form.addEventListener("submit", function(event) {
  event.preventDefault();
  console.log("form submitted");
  let searchval = searchinput.value;
  ajaxManager("submit", searchval);
})
searchinput.addEventListener("keyup", function() {
  let searchval = searchinput.value;
  if(searchval == '') {
    ajaxoutputdiv.style.display = "none";
  } else {
    ajaxoutputdiv.style.display = "initial";
    ajaxManager("query", searchval);
  }

})

// AJAX Function
function ajaxManager(type, value) {
  if(type == "submit") {
    rtype = "&submit=true";
  } else {
    rtype = '';
  }
  let xhr = new XMLHttpRequest();
  let request = "ajax-search.php?q=" + value + rtype;
  xhr.open(
    "GET",
    request,
    true
  );

  xhr.onload = function() {
    if(this.status == 200) {
      console.log(this.responseText);
      if(this.responseText >= 1) {
        outputNumArticles(this.responseText);
      } else if (this.responseText == 0) {
        outputWarning();
      } else {
        let output = JSON.parse(this.responseText);
        outputSearchResults(output);
      }
    }
  }
  xhr.send();
}
// Helper/genderal function
function outputSearchResults(rows) {
  output = '';
  let articlesh2 = document.querySelector(".recent-articles h2");
  let articlesrow = document.querySelector(".recent-articles .row");

  rows.forEach((item) => {
    output+= `<div class="col-md-6"><h3><a  href="article.php?id=${item.ID}">${item.post_title}</a></h3>
    <img class='img-fluid' src='${item.post_img}' alt=''>
    <p>${item.post_body}</p></div>`;
  });
  articlesh2.textContent = "Found articles.....";
  articlesrow.innerHTML = output;


}
function outputNumArticles(num) {
  let output = `<div class="alert alert-success mt-3" role="alert"> ${num} Article(s) were found!</div>`;
  ajaxoutputdiv.innerHTML = output;
}

function outputWarning() {
  let output = `<div class="alert alert-warning mt-3" role="alert"> No Articles were found!</div>`;
  ajaxoutputdiv.innerHTML = output;
}



// add event listener, prevent default submission and get
//textarea value

theform.addEventListener("submit", function(event) {
  event.preventDefault();
  commentAjax(thecomment.value, hiddeninput.value);
  theform.reset();
})

commentcard.forEach((card, i) => {
  card.addEventListener("click", function(e) {
    e.preventDefault();
    console.log("click");
    if(e.target.classList.contains("delete-post")){
      console.log("delete");
      let par = e.target.parentNode.parentNode.parentNode;
      console.log(par);
      par.classList.add("shrinkStart");
      setTimeout(function(){
        par.classList.add("shrinkFinish");
      },100);
    }

    console.log(e);
  })

});


// ajax request

function commentAjax(comment, postid) {

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "func/commentmanager.php", true);
  // to use the post method we must set the request headers
  // depending on the form data being sent
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function() {
    if(this.status == 200) {
      console.log(this.responseText);
      let output = JSON.parse(this.responseText);
      console.log(output);

      outputNewComment(output);
    }
  }

  xhr.send("comment="+comment+"&"+postid);
}

// General function
function outputNewComment(output) {
  let newdiv = document.createElement("div");
  newdiv.classList = "col-md-7 mt-2 mb-2";
  commentsdiv.prepend(newdiv);
  let theoutput = `<div class="card"><div class="card-header">${output.user_name} | ${output.date_created}</div>
  <div class="card-body"><p class="card-text">${output.comment_text}</p>
  </div></div>`;
  newdiv.innerHTML = theoutput;

}
