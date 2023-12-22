// Блокирует нажатие кнопки создания задачи, если поле задачи пустое,
// снимает и устанавливает тип курсора
document.getElementById('description').addEventListener('input', function() {
    var descriptionValue = document.getElementById('description').value;
    var newTaskButton = document.getElementById('btnNewTask');

    if (descriptionValue) {
        newTaskButton.removeAttribute('disabled');
        newTaskButton.style.cursor = 'pointer';
    } else {
        newTaskButton.setAttribute('disabled', 'disabled');
        newTaskButton.style.cursor = 'not-allowed';
    }
});



