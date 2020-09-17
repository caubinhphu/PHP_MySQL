<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todo</title>
  <style type="text/css">
    body {
      max-width: 500px;
      margin: 0 auto;
      padding: 10px 0;
    }
    #form-todo {
      text-align: center;
    }
    #todo-list {
      list-style: none;
      padding: 0;
    }
    #todo-list > li {
      display: flex;
      padding: 5px;
      border-bottom: 1px solid lightgray;
    }
    #todo-list div {
      flex: 1 1 auto;
    }
    #todo-list input[type="text"] {
      width: 90%;
    }
  </style>
</head>
<body>
  <form action="todo.php" method="POST" id="form-todo">
    <label for="todo">Todo</label>
    <input type="text" name="todo" id="todo" placeholder="Enter new todo">
  </form>
  <ul id="todo-list"></ul>
  <script>
    // get list data
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        if(this.responseText === 'ERROR') {
          console.error('ERROR');
        } else {
          const data = JSON.parse(this.responseText);
          data.forEach(item => {
            document.querySelector('#todo-list').prepend(genItemLi(item));
          });
        }
      }
    };
    xhr.open("GET","/php_mysql/todo.php", true);
    xhr.send();


    // post item
    const formTodo = document.querySelector('#form-todo');
    formTodo.addEventListener('submit', function(e) {
      e.preventDefault();
      addTodo(this.elements.todo.value);
    });

    function addTodo(todo) {
      if (todo) {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText); 
            if(this.responseText === 'ERROR') {
              console.error('ERROR');
            } else {
              const data = JSON.parse(this.responseText);
              data.forEach(item => {
                document.querySelector('#todo-list').prepend(genItemLi(item));
              });
              
              formTodo.reset();
            }
          }
        };
        xmlhttp.open("POST","/php_mysql/todo.php", true);
        xmlhttp.send(new FormData(formTodo));
      }
    }
    function genItemLi(item) {
      const li = document.createElement('li');
      li.dataset.id = item.id;
      li.innerHTML = `<input type="checkbox" ${+item.isCompleted ? 'checked' : ''}>
        <div>
          <span>${item.content}</span>
          <input type="text" style="display: none" value="${item.content}">
        </div>
        <button>Xóa</button>`;

      // delete item
      li.querySelector('button').addEventListener('click', () => {
        const xhrDel = new XMLHttpRequest();
        xhrDel.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            if (this.responseText === 'ERROR') {
              console.error('ERROR')
            } else if (this.responseText === 'OK') {
              li.remove();
            }
          }
        }
        xhrDel.open("POST","/php_mysql/todo.php", true);
        xhrDel.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhrDel.send(`id=${li.dataset.id}`);
      });

      // change completed
      li.querySelector('input[type="checkbox"]').addEventListener('change', function() {
        const xhrChange = new XMLHttpRequest();
        xhrChange.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            if (this.responseText === 'ERROR') {
              console.error('ERROR')
            }
          }
        }
        xhrChange.open("POST","/php_mysql/todo.php", true);
        xhrChange.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhrChange.send(`id=${li.dataset.id}&completed=${this.checked}`);
      });

      li.querySelector('div').addEventListener('dblclick', function() {
        this.children[0].style.display = 'none';
        this.children[1].value = this.children[0].innerHTML;
        this.children[1].style.display = 'block';
      });

      li.querySelector('input[type="text"]').addEventListener('keydown', function(e) {
        if(e.keyCode === 13) {
          this.style.display = 'none';
          this.previousElementSibling.style.display = 'block';
          if (this.value) {
            this.previousElementSibling.innerHTML = this.value;
            const xhrChange = new XMLHttpRequest();
            xhrChange.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                if (this.responseText === 'ERROR') {
                  console.error('ERROR')
                }
              }
            }
            xhrChange.open("POST","/php_mysql/todo.php", true);
            xhrChange.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhrChange.send(`id=${li.dataset.id}&content=${this.value}`);
          }
        }
      });

      return li;
    }
  </script>
</body>
</html>