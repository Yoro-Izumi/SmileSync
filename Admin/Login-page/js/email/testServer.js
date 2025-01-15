const express = require("express");
const bodyParser = require("body-parser");
const nodemailer = require("nodemailer");

const app = express();
const PORT = 4000;

// Middleware to parse JSON
app.use(bodyParser.json());

// Nodemailer transporter
const transporter = nodemailer.createTransport({
    service: "gmail",
    auth: {
        user: "smilesyncco@gmail.com", // Your email
        pass: "nyks nagm psxp abzv", // App password from Google
    },
});

// Email-sending route
app.post("/send-email", async (req, res) => {
    const { email, subject, content } = req.body;

    if (!email || !subject || !content) {
        return res.status(400).json({ error: "Missing required fields." });
    }

    try {
        const info = await transporter.sendMail({
            from: '"SmileSync.site" <smilesyncco@gmail.com>',
            to: email,
            subject: subject,
            html: content,
        });

        console.log("Email sent successfully:", info.messageId);
        res.status(200).json({ message: "Email sent successfully." });
    } catch (error) {
        console.error("Error sending email:", error.message);
        res.status(500).json({ error: "Failed to send email." });
    }
});

// Start the server
app.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
});
