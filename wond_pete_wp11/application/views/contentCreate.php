				<div id="content"> <!-- content div -->
					<div class="blurb">Create Something Wonderful:</div>
					<div>
						<form id="editor" class="formDesign" method="post" action="">
							<!-- markup for title input field, value attribute set from error check if required -->
							<label name="tile">Post Title (max 25 characters):</label>
							<input name="title" type="text" value='<?php formLastValue('title'); ?>' class="longInput"/>
							<div class="errorText"><?php echo $error['title']; ?></div>
							<!-- markup for post content input field, value attribute set from error check if required -->
							<textarea name="editor1"><?php formLastValue('editor1'); ?></textarea>
        					<script>CKEDITOR.replace('editor1',{toolbar:'Basic',uiColor:'#888888'});</script>
							<div class="errorText"><?php echo $error['editor1']; ?></div>
							<!-- markup for category radio buttons -->
							<label name="category">Select a category:</label>
							<span>html</span>
							<input class="radio" type="radio" name="category" value="html" checked/>
							<span>CSS</span>
							<input class="radio" type="radio" name="category" value="CSS"/>	
							<span>Javascript</span>
							<input class="radio" type="radio" name="category" value="javascript"/>
							<!-- mark up for form submission button -->
							<button class="submitButton" type="submit">Publish Post</button>
       					</form>
					</div>
				</div> <!-- end of content div -->