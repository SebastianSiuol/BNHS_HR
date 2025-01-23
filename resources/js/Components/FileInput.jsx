export function FileInput({ file, onFileChange, label = "Browse...", placeholder = "No File Selected" }) {

    const labelClass = 'flex items-center font-bold text-white text-sm bg-gray-800 hover:bg-gray-700 border border-gray-200 cursor-pointer rounded-md';
    const inputClass = 'flex-grow py-2 px-2 text-black font-normal bg-gray-50 border border-l-gray-600 rounded-r-md';


      return (
          <label className={labelClass}>
              <span className={`px-4`}>{label}</span>
              <input
                  type="file"
                  hidden
                  onChange={(e) => {
                    const selectedFile = e.target.files[0];
                    onFileChange(selectedFile);
                  }}
                  />
              <input type="text" placeholder={file ? file.name : placeholder} value={file?.name || ""} readOnly disabled className={inputClass}  />
          </label>
      );
  }
