const express = require("express");
const cors = require('cors');
const bodyParser = require("body-parser");
const nodemailer = require("nodemailer");

const app = express();
const PORT = 4000;

// Middleware
app.use(bodyParser.json());
// Enable CORS for all origins
app.use(cors());

// Email sending route
app.post("/send-email", async (req, res) => {
  const { to, subject, html } = req.body;

  if (!to || !subject || !html) {
    return res.status(400).json({ error: "All fields (to, subject, html) are required." });
  }

  try {
    // Create transporter
    const transporter = nodemailer.createTransport({
        service: "gmail",
        auth: {
            user: "smilesyncco@gmail.com", // Your email
            pass: "nyks nagm psxp abzv", // App password from Google
        },
    });

    // Send mail
    await transporter.sendMail({
      from: '"SmileSync" smilesyncco@gmail.com', // Replace with your email
      to,
      subject,
      html,
    });

    res.json({ success: true, message: "Email sent successfully!" });
  } catch (error) {
    console.error("Error sending email:", error);
    res.status(500).json({ error: "Failed to send email." });
  }
});

app.listen(PORT, () => {
  console.log(`Server is running on http://localhost:${PORT}`);
});
