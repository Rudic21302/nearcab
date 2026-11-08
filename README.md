# NearCab

A waitlist page for a taxi dispatch product that does not exist, painted in watercolour and built as a WordPress block theme with Claude Code. One pinned screen: the scroll drives a cab from stop to stop, and between stops the camera lifts over a real Voronoi map of the city.

This repo holds the finished theme and the knowledge base it was built from, so you can rebuild the page yourself.

The story behind it: [What Claude can ship in 24 hours](https://jovanrudic.com/blog/what-claude-can-ship-in-24-hours/)

## Build it yourself

All you start with is the `truth/` folder and a fresh Claude Code install. No plugins, skills or settings are needed: the design work is already written down in `truth/`.

### What you need

| | |
|---|---|
| A WordPress site on your computer, 6.6+ | [Local](https://localwp.com) is the easiest. Use a new, empty site, because the theme takes over every URL |
| Node 22+ | [nodejs.org](https://nodejs.org) |
| Claude Code | See below. Needs a Pro, Max, Team, Enterprise or Console account; the free plan does not include it |

You don't need Composer, Docker, a host, a domain or a pipeline.

### 1. Install Claude Code

macOS, Linux, WSL:

```bash
curl -fsSL https://claude.ai/install.sh | bash
```

Windows PowerShell:

```powershell
irm https://claude.ai/install.ps1 | iex
```

Open a new terminal and check it with `claude --version`.

### 2. Make the empty folder

Create a site in Local, then click **Go to site folder**. Inside `app/public/wp-content/themes/`, make a new folder called `my-nearcab` and copy `truth/` into it:

```
wp-content/themes/my-nearcab/
  truth/
```

### 3. Start Claude there

```bash
cd "path/to/wp-content/themes/my-nearcab"
claude
```

The first run opens your browser to log in. Say yes when it asks whether to trust the folder.

### 4. Give it one sentence

```
Read truth/START.md and follow it.
```

Claude checks your machine, builds the theme next to `truth/`, compares it with the demo in a browser at several screen sizes, and asks for your approval.

It will ask permission for commands such as `npm install`. Read them and approve them. On a fresh install there is no browser tool, so it installs Playwright in a temporary folder for the checks. It asks before it activates the theme.

The original build reached its first full self-check in about 40 minutes. A usage limit can pause a run; say "continue" once it lifts. Results will differ from run to run.

Already cloned this repo? Run `claude` in its root and use `/nearcab-build`. It asks where your WordPress is.

## Local, hosting and CI/CD

**Local:** everything runs on your machine, and Local serves the site. `truth/` stays in the theme folder while you work and does no harm there.

**Hosting:** any WordPress host running 6.6+ and PHP 8.0+ will do. The host needs no Node or Composer, because `build/` and `vendor/` travel with the theme. From `wp-content/themes/`:

```bash
zip -r my-nearcab.zip my-nearcab -x 'my-nearcab/node_modules/*' 'my-nearcab/truth/*' 'my-nearcab/.git/*'
```

On Windows, copy the folder without those three and compress it. Then upload the zip (about 3 MB) in **Appearance → Themes → Add New Theme → Upload Theme**, and activate it. Connect the form first; see below.

**CI/CD:** you don't need it for a one-page theme. If you want deploys on push, your pipeline has five steps:

1. Check out the repo.
2. Set up Node 22.
3. Run `npm ci` and `npm run build`.
4. Copy the theme to the host's `wp-content/themes/my-nearcab/` over SSH, leaving out `node_modules/`, `truth/` and `.git/`.
5. Keep the SSH key in your CI's secrets, never in the repo.

Commit `vendor/` either way. Ignore `node_modules/`. Commit `build/` only if you deploy without a pipeline.

## Just see it and play

Copy `theme/nearcab-theme/` into `wp-content/themes/` and activate NearCab on an empty local site. It is already built, and every URL on the site shows the page. Change any text in the Site Editor. To change the code, run `npm ci` and `npm run build` in that folder.

To work the way the project was built, copy `truth/` into the theme folder, start `claude` there, and paste a prompt from `truth/repeatable-prompts/PROMPT-INDEX.md`. The vault is Claude's working memory: `truth/CLAUDE.md` holds the rules, `truth/management/TASK-LOG.md` holds where things stand, and each session reads them first and updates them before it ends. `truth/management/TASKS-SHORT.md` has things to try.

For the design alone, serve `truth/design/ride-test/` with any static server and open `index.html`.

## Before you publish

The waitlist form goes nowhere until you connect it. In the Site Editor, open the NearCab Door block and set:

- `formAction` to your mailing list's form address
- `termsHref` and `privacyHref` to your own pages
- `note` to what your form really does

The End block needs your own name and link too. The same panels edit every other line of copy.

## Safety

- The theme makes no outside requests: no analytics, no cookies of its own, no web fonts from other servers.
- The form collects nothing until you connect it.
- This repo holds no accounts, passwords, keys or personal data, and the vault's rules tell Claude to keep it that way.
- Claude only asks to run commands on your computer. Read them before you approve them, and use a test site.
- Never upload `truth/` to a public server. The zip command above leaves it out.

## What's here

| Folder | What |
|---|---|
| `truth/` | The knowledge base, also an Obsidian vault. Start at `truth/README.md` |
| `theme/nearcab-theme/` | The finished theme |
| `.claude/commands/nearcab-build.md` | The one command |

The theme uses block templates, `theme.json` as the only token source, React in the editor, PHP render and the Interactivity API on the front end, CSS scroll-driven animations, Tailwind v4 and Vite.

## License

Code: MIT. Paintings: CC BY-NC 4.0. Fonts: SIL OFL. Details in [LICENSE](LICENSE).

Made by [Jovan Rudić](https://jovanrudic.com).
