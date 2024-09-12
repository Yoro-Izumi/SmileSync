<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* Input field styles */
        .input-wrap {
            position: relative;
            height: 37px;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .input-field {
            position: absolute;
            width: 100%;
            height: 100%;
            background: none;
            border: none;
            outline: none;
            border-bottom: 1px solid #bbb;
            padding: 0;
            font-size: 0.7rem;
            color: #151111;
            transition: 0.4s;
        }

        label {
            position: absolute;
            left: 5px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.7rem;
            color: #bbb;
            pointer-events: none;
            transition: 0.4s;
        }

        .input-field.active {
            padding-left: 2px;
            border: 2px solid #164e8a;
            border-radius: 5px;
        }

        .input-field+label {
            font-size: 0.8rem;
            font-weight: bold;
            color: #000;
            background-color: #fff;
        }

        .input-field.active+label {
            font-size: 0.7rem;
            font-weight: bold;
            color: #000;
            top: 0;
            left: 10px;
            background-color: #fff;
        }

        /* Button styles */
        #multi-step-form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 10px auto;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        button.prev-btn {
            background-color: #6c757d;
        }

        button.prev-btn:hover {
            background-color: #5a6268;
        }

        /* Form Step Container */
        .form-step {
            display: none;
            width: 100%;
            max-width: 400px;
            text-align: left;
        }

        .form-step.active {
            display: block;
        }

        /* Center form elements */
        .form-step {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 50vw;
            height:auto;
        }

        /* Toggle navigation */
        .toggle {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            color: #000;
            font-weight: bold;
        }

        .tab.active {
            color: #007bff;
            border-bottom: 2px solid #007bff;
        }

        /* Center the form */
        #multi-step-form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
    </style>
</head>
<body>

    <div id="multi-step-form">
        <!-- Toggle navigation for steps -->
        <div class="toggle">
            <span class="tab active" data-step="step-1">Step 1</span>
            <span class="tab" data-step="step-2">Step 2</span>
            <span class="tab" data-step="step-3">Step 3</span>
        </div>

        <!-- Form Steps -->
        <form>
            <!-- Step 1 -->
            <div class="form-step active" id="step-1">
                <div class="input-wrap">
                    <input type="text" class="input-field" id="name" required>
                    <label for="name">Name</label>
                </div>
                <div class="input-wrap">
                    <input type="email" class="input-field" id="email" required>
                    <label for="email">Email</label>
                </div>
                <button type="button" class="next-btn" data-next="step-2">Next</button>
            </div>

            <!-- Step 2 -->
            <div class="form-step" id="step-2">
                <div class="input-wrap">
                    <input type="password" class="input-field" id="password" required>
                    <label for="password">Password</label>
                </div>
                <button type="button" class="prev-btn" data-prev="step-1">Previous</button>
                <button type="button" class="next-btn" data-next="step-3">Next</button>
            </div>

            <!-- Step 3 -->
            <div class="form-step" id="step-3">
                <div class="input-wrap">
                    <input type="date" class="input-field" id="dob" required>
                    <label for="dob">Date of Birth</label>
                </div>
                <button type="button" class="prev-btn" data-prev="step-2">Previous</button>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

    <script>
        document.querySelectorAll('.next-btn').forEach(button => {
            button.addEventListener('click', function() {
                const nextStep = this.getAttribute('data-next');

                // Move to the next tab and form step
                document.querySelector('.tab.active').classList.remove('active');
                document.querySelector(`.tab[data-step="${nextStep}"]`).classList.add('active');

                // Show the next form step
                document.querySelector('.form-step.active').classList.remove('active');
                document.getElementById(nextStep).classList.add('active');
            });
        });

        document.querySelectorAll('.prev-btn').forEach(button => {
            button.addEventListener('click', function() {
                const prevStep = this.getAttribute('data-prev');

                // Move to the previous tab and form step
                document.querySelector('.tab.active').classList.remove('active');
                document.querySelector(`.tab[data-step="${prevStep}"]`).classList.add('active');

                // Show the previous form step
                document.querySelector('.form-step.active').classList.remove('active');
                document.getElementById(prevStep).classList.add('active');
            });
        });

        // JavaScript for input field animation
        const inputs = document.querySelectorAll(".input-field");

        inputs.forEach((inp) => {
          inp.addEventListener("focus", () => {
            inp.classList.add("active");
          });
          inp.addEventListener("blur", () => {
            if (inp.value != "") return;
            inp.classList.remove("active");
          });
        });
    </script>

</body>
</html>
