<?php
include "app.php";
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Book Recommendations</title>
      <link rel="stylesheet" href="https://fonts.xz.style/serve/inter.css" />
      <link
         rel="stylesheet"
         href="https://cdn.jsdelivr.net/npm/@exampledev/new.css@1.1.2/new.min.css"
         />

        <script>
        function update_book(id, title, author) {
            let new_title = prompt("Please enter new title:", title);
            if (new_title == null || new_title  == "") { return; }
            let new_author = prompt("Please enter new author:", author);
            if (new_author == null || new_author  == "") { return; }
            document.getElementById("new_title").value = new_title;
            document.getElementById("new_author").value = new_author;
            document.getElementById("update_id").value = id;
            document.getElementById("updateForm").submit();
        }

        function delete_book(id, title, author) {
            let is_sure = "Deleting book '" + title + "' by '" + author + "'. Are you sure?";
            if (confirm(is_sure) == true) {
                document.getElementById("delete_id").value = id;
                document.getElementById("deleteForm").submit();
            }
        }
        </script>
    </head>
    <body>
        <form id="updateForm" method="POST">
            <input type="hidden" name="update_id" id="update_id">
            <input type="hidden" name="new_title" id="new_title">
            <input type="hidden" name="new_author" id="new_author">
            <input type="hidden" name="action" value="update">
        </form>

        <form id="deleteForm" method="POST">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="delete_id" id="delete_id">
        </form>
        <header>
            <h1>Book Recommendations CRUD demo</h1>
        </header>
        <h2>Add Book</h2>
        <form method="POST">
            <label for="title">Book Title</label> <br>
            <input type="text" name="title"><br>
            <label for="author">Author</label> <br>
            <input type="text" name="author"><br>
            <input type="hidden" name="action" value="create"><br>
            <button type="submit" name="save">Save</button><br>
        </form>
      <h2>Books</h2>
        <h2>Books</h2>
        <table>
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <?php
            $results = getBooks($db);
            while ($row = $results->fetchArray()):
            ?>
            <tr>
                <td><?php echo $row["title"]; ?></td>
                <td><?php echo $row["author"]; ?></td>
                <td>
                    <button onclick="update_book(
                        <?php echo $row["id"] ?>,
                        '<?php echo $row["title"]?>',
                        '<?php echo $row["author"]?>'
                    )">Edit</button>
                </td>
                <td>
                    <button onclick="delete_book(
                        <?php echo $row["id"] ?>,
                        '<?php echo $row["title"]?>',
                        '<?php echo $row["author"]?>'
                    )">Delete</button>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
   </body>
</html>
