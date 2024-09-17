<div class="grid gap-4 mb-4 sm:grid-cols-2">
    <div>
        <x-forms.label label_name="Resume File" for="resume_file" />
        <x-forms.file-input name="resume_file"/>
    </div>
    <div>
        <x-forms.label label_name="Offer Letter" for="offer_letter" />
        <x-forms.file-input name="offer_letter"/>
    </div>
    <div>
        <x-forms.label label_name="Joining Letter" for="joining_letter" />
        <x-forms.file-input name="joining_letter"/>
    </div>
    <div>
        <x-forms.label label_name="CSC Form 212" for="csc_212" />
        <x-forms.file-input name="csc_212"/>
    </div>

    <div>
        <x-forms.label label_name="Dropbox URL" for="dropbox-url" />
        <x-forms.input name="dropbox_url" placeholder="Dropbox URL" />

    </div>
    <div>
        <x-forms.label label_name="Google Drive URL" for="gdrive-url" />
        <x-forms.input name="gdrive-url" placeholder="Google Drive URL" />
    </div>
</div>
