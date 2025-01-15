<script>
//document.getElementById("sendEmailButton").addEventListener("click", () => {
    const email = "yoroizumi@gmail.com";
    const subject = "Forget Password Link";
    const content = `
        <!DOCTYPE html>
        <html lang="en">
        <head><meta charset="UTF-8"></head>
        <body>
            <h1>Reset Your Password</h1>
            <p>Click <a href="http://smilesync.site/reset-password">here</a> to reset your password.</p>
        </body>
        </html>
    `;

    fetch("http://localhost:4000/send-email", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ email, subject, content }),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Failed to send email.");
            }
            return response.json();
        })
        .then((data) => {
            console.log(data.message);
            alert("Email sent successfully!");
        })
        .catch((error) => {
            console.error(error);
            alert("Failed to send email.");
        });
//});


</script>