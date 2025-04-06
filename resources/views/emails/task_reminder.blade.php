<!DOCTYPE html>
<html>
<head>
    <title>Task Reminder</title>
</head>
<body>
<h1>Reminder: Task Deadline Approaching</h1>
<p>Task: {{ $task->name }}</p>
<p>Description: {{ $task->description }}</p>
<p>Deadline: {{ $task->deadline }}</p>
</body>
</html>
