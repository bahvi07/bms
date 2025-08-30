<!DOCTYPE html>
<html>
<head>
    <title>Test File Upload</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <h1>Test File Upload</h1>
    <input type="file" id="fileInput">
    <button onclick="uploadFile()">Upload</button>
    
    <script>
    async function uploadFile() {
        const fileInput = document.getElementById('fileInput');
        const file = fileInput.files[0];
        
        if (!file) {
            alert('Please select a file');
            return;
        }
        
        const formData = new FormData();
        formData.append('file', file);
        
        try {
            const response = await axios.post('/test-upload', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            
            console.log('File uploaded:', response.data);
            alert('File uploaded successfully! Path: ' + response.data.path);
        } catch (error) {
            console.error('Upload failed:', error);
            alert('Upload failed: ' + (error.response?.data?.message || error.message));
        }
    }
    </script>
</body>
</html>
