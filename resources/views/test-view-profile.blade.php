<!DOCTYPE html>
<html>
<head>
<title>All Cars</title>
</head>
<body>
    @foreach ($farmer_profile as $farmerprofile)
        <p><a href="/view-farmer-profile/{{ $farmerprofile->lastname }}">{{ $farmerprofile->lastname }}</a></p>
    @endforeach
</body>
</html>