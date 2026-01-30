<!DOCTYPE html>
<html>
<head>
    <!-- <title>Amazon Labels</title> -->
</head>
<body>
    @foreach ($labels as $label)
        <div style="page-break-after: always;">
            <img src="data:image/png;base64,{{ base64_encode($label) }}" alt="Amazon Label">
        </div>
    @endforeach
</body>
</html>
