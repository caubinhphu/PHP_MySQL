document.querySelector('#todo').addEventListener('change', function() {
  console.log(this.value);
})

e.preventDefault();
var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
      }
    };
    xmlhttp.open("POST","/php_mysql/todo.php", true);
    xmlhttp.send(new FormData(document.querySelector('#todo')));