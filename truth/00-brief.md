# Brief

> Status: kick-off done.

## Idea
NearCab is the imagined end state of a public Voronoi-diagram dispatch experiment (city split into zones, nearest free cab wins). The landing page is a **waitlist page** for a SaaS startup that does not exist yet. It has its own brand and real-sounding copy, mentions the original project, and never promises the finished product. The fine print says plainly: design mockup, software not built.

## What the product would add (taken from the experiment's own "what's missing" list)
- a queue, so one cab is never sent to two callers at once
- live cab status (free, busy, off shift)
- real road distances instead of straight lines
- time of day and traffic
- a maps service for addresses and routes

## Decided
- Name: **NearCab**
- Mood: a hand-drawn watercolour storybook lens over a corporate taxi SaaS. Cars drive across a painted city map, zones bloom, lines connect a caller to the nearest cab, a cab pulls up to the door. Decorative motion, not a working app. No sterile white SaaS.

- Structure: the taxi journey. One painted taxi waits at a stop while you read; scroll drives it to the next stop (hero curb, call comes in, map lift with zones, landmark features, ticket quotes, 'what I built so far' meter, pickup CTA). Mobile: road winds down the page.
- Art: ~8 painted watercolour cut-outs on white paper (taxi side + front, road strip, map, house, station, airport, pump). Code does all motion: CSS scroll-driven animations, Interactivity API fallback, SVG zones and lines. No video, no GSAP.

- Waitlist form: tells the visitor the product does not exist yet and offers, clearly labelled, sign-up to the author's real blog newsletter instead. In this repo the form posts to an address you set.
- Footer fine print: design mockup, software not built, link to the original project.

## Blog post angle
Rushing development with Claude can be the right call, when it is used on purpose and execution time really matters. Second half: how to use Claude that way.
