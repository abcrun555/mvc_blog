function transform() {
  let address = document.URL;
  array = address.split('/');
  let postid = array.pop();
  let text = document.getElementById('text');
  let post = text.innerText;

  mainarticle.remove();
  admin.remove();


  let message = document.createElement("form");
  message.action = `/admin/update/${postid}`;
  message.method = "post";
  let header = document.getElementsByTagName('header')[0];
  header.after(message);
  let txt = document.createElement("textarea");
  message.appendChild(txt);
  txt.className = "text";
  txt.innerText = post;
  txt.name = "update";
  let button = document.createElement("button");
  button.setAttribute("onclick", "updateValidation()");
  button.innerText = "Save";
  button.id = 'upd_button';
  message.after(button);
}

function updateValidation() {
  let form = document.getElementsByTagName('form')[0];
  let textarea = document.getElementsByTagName("textarea")[0];
  let updatedStr = textarea.value;
  if (updatedStr.length > 10000 || updatedStr.length < 100) {
    wrn = document.createElement('p');
    wrn.style.color = 'red';
    wrn.innerText = 'Размер публикации  должен быть не больше десяти тысяч символов и не меньше ста символов';
    prnt = textarea.parentNode;
    prnt.insertBefore(wrn, textarea);
  } else {
    form.submit();
  }
}





// function postInform() {

  /* addEventListener("submit", function() {
    alert("Щёлк!"); */
/*   if (document.referrer.includes("/main/send")) {
    alert("Ваш пост будет опубликован после рассмотрения модератором, не позже, чем через двенадцать часов");
} */
// if (localStorage.getItem('post')) {
    // alert("Ваш пост будет опубликован после рассмотрения модератором, не позже, чем через двенадцать часов");
    // localStorage.clear();
// }

// }

    /*
    message.setAttribute("method", "post");
    message.setAttribute("action", "submit.php");
    let txt=document.createElement("input");
  message.appendChild("txt");
  
    txt.setAttribute("type","text")

    let ein= document.createElement('div');
    ein.
    ein.innerText='kdjfkwdfwdhwidh'; */



/* https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement?retiredLocale=uk */
