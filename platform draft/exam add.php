      <hr>
            <h1 class="mt-5">Add Exam questions :</h1>

            <form method="POST" action="/uploadExamQ" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="section-selector mt-5">Exam For:</label>
                    <select class="form-control" id="section-selector" name="grade">
                        <option value="1">1 Sec.</option>
                        <option value="2">2 Sec.</option>
                        <option value="3">3 Sec.</option>
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="week-selector">Exam Num:</label>
                    <select class="form-control" id="week-selector" name="examNum" required>
                        @for ($week = 1; $week <= $Global_unitNum; $week++)
                            <option value="week{{ $week }}sec4">Exam {{ $week }}</option>
                        @endfor
                    </select>
                </div>

                <!--<div class="form-group mt-4">-->
                <!--    <label for="image">Exam questions: <span class="text-danger">photos only !</span></label><br>-->
                <!--    <input type="file" class="form-control-file mt-2" id="image" name="images[]" multiple-->
                <!--        accept="image/*" required>-->
                <!--    <small class="form-text text-muted">Only images files are allowed.</small>-->
                <!--</div>-->
                <div class="form-group mt-4">
                    <label for="images">Exam questions: <span class="text-danger">photos only!</span></label><br>
                    <input type="file" class="form-control-file mt-2" id="images" name="images[]" multiple
                        accept="image/*" required>
                    <small class="form-text text-muted">Only image files are allowed.</small>
                </div>
                <input type="submit" value="Upload" class="btn btn-success mt-4">
            </form>










            Welcome to the English For All platform Presented by Mr. Mohamed El-Sherbiny with more than twenty years of experience in the secondary stage. He holds a Bachelor of Arts and Education in the English Language Department in 2002. He taught his students to love the language and how to deal with solving questions with ease and established a language and curriculum for the three secondary levels. This platform was designed specifically to solve most students’ difficulty with the English language smoothly, simply, and without complexity. Our goal is not to teach a curriculum only, but to establish a language and make the student able to solve any question without fears, how to solve the exam using the modern system, and training in a lot of solving exams and learning English language skills: listening speaking reading writing The solution is detailed for each part choose,Reading,Skills, Translation,Essay,Story .. etc)

