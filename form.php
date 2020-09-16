<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h2>POST</h2>
  <form action="/php_mysql/_form.php" method="POST">
    <div>
      <label for="text">Text box</label>
      <input type="text" name="text" id="text">
    </div>
    <div>
      <label for="textarea">Textarea</label>
      <textarea name="textarea" id="textarea" cols="30" rows="5"></textarea>
    </div>
    <div>
      <label for="date">Text date</label>
      <input type="date" name="date" id="date">
    </div>
    <div>
      <label>Radio</label>
      <input type="radio" name="radio" id="radio1" value="1">
      <label for="radio1">Radio 1</label>
      <input type="radio" name="radio" id="radio2" value="2">
      <label for="radio2">Radio 2</label>
    </div>
    <div>
      <label for="select">Select</label>
      <select name="select" id="select">
        <option value="1">option 1</option>
        <option value="2">option 2</option>
        <option value="3">option 3</option>
        <option value="4">option 4</option>
      </select>
    </div>
    <div>
      <button type="submit">Submit</button>
    </div>
  </form>
  <h2>GET</h2>
  <form action="/php_mysql/_form.php" method="GET">
    <div>
      <label for="name">Name</label>
      <input type="text" name="name" id="name">
    </div>
    <div>
      <button type="submit">GET</button>
    </div>
  </form>
</body>
</html>