const express = require("express");
const nodemailer = require("nodemailer");
const bodyParser = require("body-parser");
const cors = require("cors");

const app = express();
app.use(bodyParser.json());
app.use(cors());

// Set up Nodemailer transporter
const transporter = nodemailer.createTransport({
  service: "gmail", // Replace with your email service
  auth: {
    user: "smilesyncco@gmail.com", // Your email
    pass: "nyks nagm psxp abzv", // App password from Google
  },
});

// Email sending route
app.post("/send-email", async (req, res) => {
  const { to, subject, text } = req.body;

  const mailOptions = {
    from: "smilesyncco@gmail.com",
    to,
    subject,
    text,
  };

  try {
    await transporter.sendMail(mailOptions);
    res.status(200).send({ success: true, message: "Email sent successfully!" });
  } catch (error) {
    res.status(500).send({ success: false, message: "Failed to send email.", error });
  }
});

// Start the server
const PORT = 3000;
app.listen(PORT, () => console.log(`Server is running on port ${PORT}`));

// Continuous interval logic (if needed)
setInterval(() => {
  console.log("This script is running continuously...");
}, 1000); // Runs every second
