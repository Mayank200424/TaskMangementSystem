<!DOCTYPE html>
<html>
<head>
    <title>Pending Task Reminder</title>
</head>
<body>
    <h2>Reminder: You have a pending task!</h2>
    <p><strong>Title:</strong> {{ $task->title }}</p>
    <p><strong>Description:</strong> {{ $task->description }}</p>
    <p><strong>Due Date:</strong> {{ $task->due_date }}</p>
    <p>Please complete this task as soon as possible.</p>
</body>
</html>
