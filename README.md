## Table of Contents
1. [Proposing Changes](#proposing-changes)
2. [Code Style Guidelines](#code-style-guidelines)
3. [Commit Messages](#commit-messages)
4. [Submitting a Pull Request](#submitting-a-pull-request)
5. [Issues and Labels](#issues-and-labels)
6. [Guidelines](#guidelines)

### Proposing Changes
If you'd like to propose changes or additions to the project:

1. Fork the repository to your GitHub account.
2. Create a new branch for your changes.
3. Make your changes and commit them.
4. Push the changes to your forked repository.
5. Create a pull request on the main repository.

### Code Style Guidelines
To maintain consistency and readability, follow these code style guidelines:

- 4 spaces per indentation level, no tabs.
- Use camelCase for variable and function names. 
- Use whitespace to make code more readable.
- No trailing whitespace at the end of a line.
- Only use comments to explain the algorithm.
- Space between `if` and `(` (if (param) ...).

### Commit Messages
Please follow the conventional commit message format for our commits:

- **Type**: Start with a type, such as:
    - `fix`:  A bug fix.
    - `docs`: Documentation changes.
    - `style`: Changes that do not affect the meaning of the code (formatting, etc.).
    - `refactor`: A code change that neither fixes a bug nor adds a feature.
- **Imperative Mood**: Write the commit message in the imperative mood (e.g., "Add feature" instead of "Added feature").
- **Concise and Descriptive**: Keep it clear and concise, providing relevant details without unnecessary information.
- **Reference Issues**: If your commit relates to a specific issue, include a reference to that issue in the commit message. For example, "Fix #123: Resolve bug with problemName.cpp."

Example commit message 1:
```
fix: Fix calculation bug in "Diamond Shape.cpp"

Use double instead of float for more precision.

Closes #5
```

Example commit message 2:
```
refactor: Simplify "Diamond Shape.cpp" algorithm for improved readability

Replace repetitive code with a reusable function.
```

### Submitting a Pull Request
When submitting a pull request:

1. Provide a clear title and description of your changes.
2. Reference any related issues in your pull request.
3. Ensure your branch is up-to-date with the main repository.

### Issues and Labels
Use labels to categorize issues. Please apply the appropriate label when creating or triaging issues.

- `documentation`: Issues related to improving or clarifying existing documentation.
- `enhancement`: Suggestions for enhancing the content or adding new guides.
- `bug`: Issues related to errors, inaccuracies, or problems in the documentation.
- `question`: Questions about the content or requests for clarification.
- `proposal`: Proposals for new documentation topics or guides.
- `formatting`: Issues related to the formatting or structure of the documentation.
- `clarification`: Requests for additional clarification on specific sections.
- `discussion`: Open-ended discussions about potential improvements or changes.
- `contribution-welcome`: Indicates that contributions on this issue are welcome.

### Guidelines
	Download git
		-> Buka vscode, ke side bar bagian source control (logo 3 bulet sama garis)
		-> Download 32/64 bit (kalo ragu, pilih 64 bit) windows setup (bukan portable)
		-> Next semua sampe install
		-> Re-open vscode
		-> Gk ush launch gitbash/open release notes, langsung finish aja
		-> Cek di side bar yang logo 3 bulet sama garis, pastiin nggk disuruh donwload git lagi

	Pulling projects
		-> Buka https://github.com/Mona-besar/Konsekuensi
		-> Click fork
		-> Nama fork bebas trus save
		-> Buka new window VSCode
		-> Click ctrl + shift + e
		-> Click clone repository -> Clone from github -> pilih repo yg tadi baru kebuat dari fork
		-> Download nodejs di nodejs.org/en versi LTS
		-> Cek udh kedownload ato belom pake `npm --v`
		-> Run di command console `composer update` buat download vendor
		-> Copy `example.env`
		-> Rename yg baru dicopy jadi `.env`
		-> run `php artisan serve`
		-> Kalo gk bisa DM T061
	
		General naming convention
		DATABASE -> SELECT * FROM
		Class -> PascalCasing, AkuMakanNasi
		function/variable -> camelCase, akuMakanNasi
		khusus HTML CSS, aku-makan-nasi

	Create pull request
		-> Di file kalian kerja, di paling atas banget, taro comment, file ini ngapain aja, dan apa aja yg perlu kita tahu
		-> PASTIIN KODE KALIAN UDH PALING UP TO DATE SAMA REPO MASTER
		-> PASTIIN GADA ERROR DAN JALAN SAMA KODE ORANG LAIN
		-> Kalo udah yakin semuanya jadi, click contribute di page utama repo kalian (yang difork)
		-> Click open new pull request ato apa gitu
		-> Tunggu diaccept sama master
		-> Tidur
