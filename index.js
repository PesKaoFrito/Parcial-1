function addTask() {
    const taskInput = document.getElementById("task-input");
    const descriptionInput = document.getElementById("description-input");
    const dateInput = document.getElementById("date-input");
    const priorityInput = document.getElementById("priority-input");

    const taskText = taskInput.value.trim();
    const description = descriptionInput.value.trim();
    const date = dateInput.value;
    const priority = priorityInput.value;
    
    if (taskText === "") return;

    // Aquí vamos a hacer la solicitud AJAX
    fetch('save_task.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `user_id=1&task_name=${taskText}&description=${description}&date=${date}&priority=${priority}&status=todo`,
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Aquí puedes manejar la respuesta de tu archivo PHP
    })
    .catch((error) => {
        console.error('Error:', error);
    });

    const newTask = document.createElement("li");
    newTask.className = "task";

    //Evento de doble clic para mover la tarea
    newTask.addEventListener('dblclick', moveTask);

    const taskName = document.createElement("div");
    taskName.className = "task-name";
    taskName.innerHTML = `<strong></strong> <span contenteditable="true">${taskText}</span>`;

    const taskDescription = document.createElement("div");
    taskDescription.className = "task-description";
    taskDescription.innerHTML = `<strong>Descripción:</strong> <span contenteditable="true">${description}</span>`;

    const taskDate = document.createElement("div");
    taskDate.className = "task-date";
    taskDate.innerHTML = `<strong>Fecha:</strong> <span contenteditable="true">${date}</span>`;

    const taskPriority = document.createElement("div");
    taskPriority.className = "task-priority";
    taskPriority.innerHTML = `<strong>Prioridad:</strong> <span contenteditable="true">${priority}</span>`;

    newTask.appendChild(taskName);
    newTask.appendChild(taskDescription);
    newTask.appendChild(taskDate);
    newTask.appendChild(taskPriority);

    const todoList = document.getElementById("todo-list");
    todoList.appendChild(newTask);

    taskInput.value = "";
    descriptionInput.value = "";
    dateInput.value = "";
    priorityInput.value = "Urgente";
    
    // Actualiza la última tarea agregada
    lastAddedTask = newTask;
}

function moveTask() {
    const task = this;
    const currentList = task.parentElement;
    const targetList = currentList.id === "todo-list" ? "in-progress-list" : currentList.id === "in-progress-list" ? "done-list" : "todo-list";
    document.getElementById(targetList).appendChild(task);
}

function deleteLastTask() {
    if (lastAddedTask) {
        lastAddedTask.parentElement.removeChild(lastAddedTask);
        lastAddedTask = null;
    }
}
