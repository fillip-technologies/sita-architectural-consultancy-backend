<form action="/import-users" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required>
    <button>Import</button>
</form>

<a href="/export-users">Export Users</a>
