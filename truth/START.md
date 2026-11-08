# Start here (for Claude)

You build NearCab from zero in the reader's WordPress. `truth/` is your only input. If a `theme/` folder exists beside it, do not read it: it is the finished answer.

## 1. Where the theme goes
If the current folder is inside `wp-content/themes/`, build here, next to `truth/`. Otherwise ask for the path to the `wp-content/themes/` folder and build in `my-nearcab` inside it.

## 2. Check the machine
Check Node 22+ and that the WordPress site answers in a browser. Ask for the site URL if you can't find it. If something is missing, say what and how to get it, then stop.

Install Playwright and Chromium in a temporary folder outside the theme for the checks. Never add them to the theme's `package.json`.

## 3. Build
Read `truth/CLAUDE.md` and `truth/README.md`, then the files under "To build", in order. Build per `truth/wp-package/BUILD-SPEC.md`.

Ask before activating the theme: it replaces the site's current one and takes over every URL.

## 4. Check
Serve the demo and run `truth/wp-package/SELF-CHECK.md`. Fix until it passes.

## 5. Approve
Send the reader the contact sheets and the results table, say which checks did not run, and ask one question: approve, or what to change. Apply the answer, check again, and repeat until approved.

Do not submit the waitlist form to any real address. Do not publish, deploy or push anything.

When the reader approves, update `truth/management/TASK-LOG.md`. From then on, `truth/CLAUDE.md` and that log carry the project.
