<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload PDF to Azure</title>
</head>
<body>
    <h1>Upload PDF to Azure Blob Storage</h1>

    <!-- Display Success/Error Message -->
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <!-- Upload Form -->
    <form action="/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file">Choose a PDF file:</label>
        <input type="file" name="file" id="file" accept="application/pdf" required>
        <br><br>
        <button type="submit">Upload</button>
    </form>

    <!-- Show Download and Delete options if file is uploaded -->
    @if (session('uploadedFile'))
        <h2>File Uploaded: {{ session('uploadedFile') }}</h2>

        <!-- Download Link -->
        <a href="{{ url('/download/' . session('uploadedFile')) }}" target="_blank">Download</a>

        <!-- Delete Link -->
        <form action="{{ url('/delete/' . session('uploadedFile')) }}" method="POST" style="display: inline;">
            @method('DELETE')
            @csrf
            <button type="submit" style="color: red;">Delete</button>
        </form>
    @endif
</body>
</html>
