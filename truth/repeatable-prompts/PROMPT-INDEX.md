# Prompts to copy and paste

Run these with Claude Code in the theme folder, with `truth/` next to the theme files.

**Build from zero**
```
Read truth/START.md and follow it.
```

**Start or continue a session**
```
Read truth/CLAUDE.md and truth/management/TASK-LOG.md. Tell me where things stand and what you suggest next, then wait.
```

**Change something**
```
Read truth/CLAUDE.md. Task: [what you want]. List the files you will change and what you will not touch. Then do it, rebuild, and check it at 390 and 1440 wide.
```

**Re-check the page**
```
Run truth/wp-package/SELF-CHECK.md against this site. Show me the results and say which checks did not run.
```

**End a session**
```
Update truth/management/TASK-LOG.md with what changed and what is next. Add any new decision to truth/LOG.md with its date and reason.
```

**Keep the vault honest**
```
Compare the vault with the theme code. List anything out of date, and any password, token or personal data that doesn't belong. Change nothing yet.
```
