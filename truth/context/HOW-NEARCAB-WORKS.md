# How NearCab works

One pinned screen, one scroll animation. The page is 820vh tall, the stage sticks to the viewport, and the scroll position drives everything through CSS `animation-timeline`.

## The stage
| Layer | What it does |
|---|---|
| Header | Brand and the waitlist button, always on top |
| Street band | Three back and three front paintings, the road, the cab with wheels, lights and exhaust. Pans left stop by stop |
| Sky map | The street map with 11 Voronoi zones. Takes over between stops 1 and 3 |
| Frames | Six reading stops, each its own block |

## The stops
| Block | Stop | `data-hold` (% of the ride) |
|---|---|---|
| `pickup` | First screen | 0 |
| `call` | A phone rings | 16 |
| `sky` | Above the city | 45 |
| `garage` | What exists today | 69 |
| `door` | The waitlist | 83 |
| `end` | End of the line | 100 |

## JavaScript (`blocks/ride/view.js`)
CSS does the motion. The Interactivity store only does what CSS can't:
- **Measure:** frame copy taller than its reading area scrolls up during the hold. The first frame scales to fit instead.
- **Sky state:** switches on inside 24 to 56.5% and off only outside 21.5 to 59%, so small scrolls don't flicker.
- **Moving:** the wheels blur only while the reader is scrolling.
- **Jump:** the waitlist buttons and the brand ride to their stop.

Without scroll timelines, or with reduced motion, the frames are a plain page.

## Phones
The stage is `100dvh` and the frames are `svh`, so the street stays on the screen's bottom edge when the URL bar hides and the copy doesn't reflow.

## Changing things
| To change | Do this |
|---|---|
| Any text or link | Site Editor, select the block, use the side panel |
| A colour or font | `theme.json`, then `npm run build` |
| Motion | The block's `style.scss`, then run [[../wp-package/SELF-CHECK]] |
| A painting | Replace the file in `assets/nearcab/`, same name |
