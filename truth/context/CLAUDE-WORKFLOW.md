# How the work runs

The method behind NearCab. Claude has no memory between sessions, so the vault holds it.

## The loop
1. **Write it down first.** Brief, tokens and rules go in the vault before any page exists.
2. **Prove the look in one file.** The demo settles design and motion before WordPress is involved.
3. **Spec from what works.** `BUILD-SPEC` describes the demo; it doesn't compete with it.
4. **Build in one run.** One command, one source of truth.
5. **Measure.** Scroll in 1% steps and read the numbers. A reversing car doesn't show in a screenshot.
6. **Show, then ask one question.** Approve, or what to change. Repeat.
7. **Log it.** Decisions and reasons go in [[../LOG]], state goes in [[../management/TASK-LOG]].

## Sessions
- A session starts by reading `truth/CLAUDE.md` and `management/TASK-LOG.md`.
- One session, one job. Independent work gets its own session.
- A session ends by updating the task log. The next one starts from there.
- If a usage limit stops a session, the task log tells the next one where to pick up.

## Releases
Keep a local site for building, and let branches stand for environments: `dev` for work, `stage` for a private copy of the site, `main` for live. Changes reach `main` only through a reviewed merge from `stage`. Secrets stay in your CI's settings.

## When a decision changes
Write the new decision in [[../LOG]] with its date and reason. If it replaces an ADR, mark that ADR superseded. Old notes stay as history; the vault's order of authority is in `truth/CLAUDE.md`.

## Tools
None are required beyond Claude Code and a browser tool for the checks. [[../TOOLS]] lists what the original used.
