# Cloud Photo Gallery using AWS S3

A simple, responsive photo gallery web app to upload, view, and delete images stored on AWS S3.

---

## Features  
- **Upload** images from the browser.  
- **View & Delete** images with ease.  
- **Sort** images by name, date, or size.  
- **Responsive UI** for all devices.  

---

## Prerequisites  
1. **AWS Account** – Create an AWS account.  
2. **S3 Bucket** – Set up an S3 bucket to store images.  
3. **IAM User** – Create a user with S3 permissions.  

---

## Setup Instructions  

### Step 1: Clone the Repository  
```bash  
git clone https://github.com/your-username/cloud-photo-gallery.git  
cd cloud-photo-gallery  
```  

### Step 2: Create an S3 Bucket  
1. Create a new S3 bucket in AWS.  
2. Enable **public access** or adjust permissions as needed.  
3. Create a folder called **`images/`** inside the bucket.  

### Step 3: Set Up IAM User & Credentials  
1. Create an IAM user with **programmatic access**.  
2. Attach the **AmazonS3FullAccess** policy.  
3. Get the **Access Key ID** and **Secret Access Key**.  

---

## Configuration  

Update the AWS configuration inside the `index.html` file:

```javascript  
AWS.config.update({  
    accessKeyId: "YOUR_ACCESS_KEY_ID",        // Add your Access Key ID  
    secretAccessKey: "YOUR_SECRET_ACCESS_KEY", // Add your Secret Access Key  
    region: "YOUR_AWS_REGION"                 // Example: 'us-east-1'  
});  

const bucketName = 'YOUR_BUCKET_NAME';        // Add your S3 bucket name  
```  

---

## How to Use  
1. Open **index.html** in your browser.  
2. **Upload Images:** Use the upload button to add images.  
3. **View Images:** Click any image to open it in a modal.  
4. **Delete Images:** Use the delete button with confirmation.  
5. **Sort Images:** Use the dropdown to sort by name, date, or size.  

---

## Optional: Public Bucket Policy  

Add this policy if your bucket needs public access:

```json  
{  
  "Version": "2012-10-17",  
  "Statement": [  
    {  
      "Effect": "Allow",  
      "Principal": "*",  
      "Action": "s3:GetObject",  
      "Resource": "arn:aws:s3:::YOUR_BUCKET_NAME/images/*"  
    }  
  ]  
}  
```  

---

## Troubleshooting  
- **CORS Error:** Add this CORS policy to your bucket:  
  ```json  
  {  
    "CORSRules": [  
      {  
        "AllowedOrigins": ["*"],  
        "AllowedMethods": ["GET", "POST", "PUT", "DELETE"],  
        "AllowedHeaders": ["*"]  
      }  
    ]  
  }  
  ```  
- **Invalid Credentials:** Ensure your Access Key and Secret Key are correct.  
- **Access Denied:** Confirm that the IAM user has **S3 permissions**.  

## Technologies Used  
- **HTML, CSS, JavaScript** – For the front-end.  
- **AWS SDK** – To connect with S3.  
- **S3 Bucket** – Cloud storage for images.  

## License  
This project is licensed under the **MIT License**.  

## Contributing  
Feel free to submit issues or pull requests for improvements!  


## Contact  
For any questions, reach out at [raza37487@gmail.com].  
