# Cloud Photo Gallery using AWS S3

A simple, responsive photo gallery web app to upload, view, and delete images stored on AWS S3.

---

## Features  
- **Upload** images from the browser.  
- **View & Delete** images with ease.  
- **Sort** images by name, date, or size.  
- **Responsive UI** for all devices.  

---

### **Prerequisites**
- AWS Account  
- AWS CLI (optional, but helpful)  
- HTML, CSS, JS files for the website

---

### **Create an S3 Bucket**
1. Go to **S3** on AWS Console.  
2. Click **"Create Bucket"**.  
3. Set a **unique bucket name** and region (e.g., `us-east-1`).  
4. **Disable "Block All Public Access"**.  
5. Click **Create Bucket**.

---

### **Enable Static Website Hosting**
1. In your bucket, go to the **Properties** tab.  
2. Scroll to **Static Website Hosting** and click **Edit**.  
3. Enable **"Host a Static Website"**.  
4. For **Index document**, enter `index.html`.  
5. Click **Save**.

---

### **Upload Files to S3**
1. Upload `index.html` to the **root directory**.  
2. Upload images to the `/images` directory.  
3. Ensure that files are publicly accessible:
   - Go to **Permissions > Bucket Policy** and add a policy like:

```json
{
    "Version": "2012-10-17",
    "Statement": [
        {
            "Sid": "PublicReadGetObject",
            "Effect": "Allow",
            "Principal": "*",
            "Action": "s3:GetObject",
            "Resource": "arn:aws:s3:::Your-Bucket-Name/*"
        }
    ]
}
```

4. Replace `your-bucket-name` with your actual bucket name.

---

Here’s the **CORS configuration** for your S3 bucket in JSON format:

```json
[
    {
        "AllowedHeaders": [
            "*"
        ],
        "AllowedMethods": [
            "GET",
            "PUT",
            "POST",
            "DELETE"
        ],
        "AllowedOrigins": [
            "*"
        ],
        "ExposeHeaders": []
    }
]
```

### Steps to Add CORS Configuration

1. In the **AWS Console**, open your **S3 bucket**.
2. Navigate to **Permissions > CORS Configuration**.
3. Click **Edit** and paste the above JSON configuration.
4. Save the changes.

This configuration will allow your application to perform the necessary operations without encountering cross-origin resource sharing (CORS) issues.

### **Get the Website Link**
1. Go to **Properties > Static Website Hosting**.  
2. Copy the **Endpoint URL**.  
3. Use this URL to access your gallery online!

---

### **Set AWS Credentials in the Code**
- Open the JavaScript file and **replace AWS credentials**:

```javascript
AWS.config.update({
    accessKeyId: "YOUR_ACCESS_KEY_ID",  // Replace with your access key
    secretAccessKey: "YOUR_SECRET_ACCESS_KEY",  // Replace with your secret key
    region: "YOUR_BUCKET_REGION"  // Example: "us-east-1"
});
```

---

### **License**
This project is licensed under the **MIT License** – feel free to use and modify it!

## Technologies Used  
- **HTML, CSS, JavaScript** – For the front-end.  
- **AWS SDK** – To connect with S3.  
- **S3 Bucket** – Cloud storage for images.  


## Contributing  
Feel free to submit issues or pull requests for improvements!  


## Contact  
For any questions, reach out at [raza37487@gmail.com].  
