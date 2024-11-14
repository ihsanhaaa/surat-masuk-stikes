<!DOCTYPE html>
<html>
<head>
    <title>Super Admin Logged In sipatri pnk</title>
</head>
<body>
    <p>Super Admin {{ $user->name }} has logged in sipatri pnk.</p>
    <p>IP Address: {{ $ipAddress }}</p>
    <p>Location: <a href="{{ $locationUrl }}" target="_blank">View on Map</a></p>
</body>
</html>
