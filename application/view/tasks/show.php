<!-- Блок добавления новой задачи -->
<div class = "newTask">
    <form action = "/tasks" method = "POST">
        <input type = "hidden" name = "type" value = "newTask">
        <input type = "text" placeholder = "Введите новую задачу" id = "description" name = "description">
        <button id = "btnNewTask" type = "submit" disabled> Создать </button>
    </form>
</div>

<!-- Блок управления всеми задачами -->
<div class = "manageAllTask">
    <form action="/tasks" method="POST">
        <input type = "hidden" name = "type" value = "updateAllTasks">
        <button type="submit" class = "btnCompliteAll">Выполнить все задачи</button>
    </form>

    <form action="/tasks" method="POST">
        <input type = "hidden" name = "type" value = "deleteAllTasks">
        <button type="submit" class = "btnDeleteAll">Удалить все задачи</button>
    </form>
</div>

<!-- Блок списка задач -->
<div class = "taskList">
    <?php
        //$result - массив из запроса выборки задач пользователя
        $result = $vars['tasks'];
        foreach ($result as $row){
            // Надпись на кнопке статуса
            $button_text = "Выполнено";
            if ($row["status"] == "complited"){
                $button_text = "Не выполнено";
                echo    '<style>
                            #description' . ucfirst($row['id']) . '{
                                color:rgb(67, 176, 42) !important;
                                text-decoration: line-through;
                            }
                        </style>';
            }
            
            //Блок конкретной задачи
            echo 
            '<div class = "task">

                <div class="taskContent">
                    <a id="description' . ucfirst($row['id']) . '">' .
                        $row['description'] . '
                    <a>

                    <div class="buttonsTask">
                        <form action="/tasks" method="POST">
                            <input type = "hidden" name = "type" value = "updateOneTask">
                            <input type="hidden" name="taskId" value="' . $row['id'] . '">
                            <input type="hidden" name="statusTask" value="' . $row['status'] . '">
                            <button type="submit">' . $button_text . '</button>
                        </form>

                        <form action = "/tasks" method = "POST">
                            <input type = "hidden" name = "type" value = "deleteOneTask">
                            <input type = "hidden" name = "taskId" value = "' . $row['id'] . '">
                            <button type = "submit" class="btnDelete"> Удалить </button>
                        </form>
                    </div>

                </div>

                <div class = "imgStatus">
                    <img src="public\images\\' . $row['status'] . '.png">
                </div>

            </div>';
        }
    ?>

</div>

<!-- JS -->
<script src = "public\scripts\blockButtonTask.js"></script>