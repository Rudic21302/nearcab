# The ride: how frames connect

> History: how the idea developed. The demo (`design/ride-test/`) replaced this where they differ.

> Status: proposal 2026-11-07. Owner direction: the reader is riding in the cab; the cab moves them around the page with motion. Content sits in still frames (stops); the drive connects them. The demo structure is retired; Claude Design starts fresh from this.

## The experience in one line
You get into the cab on the first screen. Every scroll is a stretch of road. At each stop the cab pulls over, the city holds still, and you read. Scroll again and the cab pulls out to the next stop. The last stop is your own front door, where you can join the waitlist.

## The route (stops = content frames)
| Stop | Where the cab is | Reader question | Content of the still frame |
|---|---|---|---|
| 0 · Pickup | A street at dusk, the cab pulls up to you | What is this? | Name, one-line promise ("the nearest cab answers"), Join the waitlist |
| 1 · The call | Outside a townhouse, a phone rings in a lit window | Why does it matter? | The problem: fourteen free cabs, one caller, the old way is a radio round and empty kilometres |
| 2 · Above the city | The view lifts: the city seen from above, cabs as dots | How does it work? | Zones: every cab owns the streets nearest to it; the call lands in one zone |
| 3 · The clock | Stopped at a light, the dashboard clock | How fast is it? | Call to curb: 2 seconds, instantly, 5 seconds, about 4 minutes |
| 4 · The garage | A small garage where the thing is being built | Can I trust it? | What exists today (built / next / later), link to the open experiment |
| 5 · Your door | The cab stops at a front door, the driver waves | What do I do next? | The waitlist sentence-form + the honest note |
| End · Night | The cab drives off into the night | Who made this? | NearCab, fine print |

## Three ways to ride (pick one)

### A. Window seat (sideways ride), recommended
The page scrolls down, the world moves sideways. The cab stays put low on the screen (you are in it), wheels turning, the street slides past in layers: far facades slow, lamps and trees fast. At a stop the scenery slows, the cab brakes with a small dip, and the stop's frame settles in next to it. Scroll on and it pulls out.
- Feels most like riding. Uses the side-view cab we already have.
- Built as pinned sections with a horizontal track moved by CSS scroll-driven animations (no GSAP); each stop is a normal readable block for screen readers and no-motion browsers.
- Phone: the same sideways ride in a strip across the screen, the frame's text above it.
- Needs: 4-5 long street panoramas (painted in 2 layers: buildings, then lamps/trees), a cab with spinning wheels as a separate layer.

### B. Road down the page
A painted road winds down the page; a top-down cab drives it as you scroll; stops sit beside the bends.
- Native vertical scroll, simplest on phones, fewest paintings (road pieces + top-down cab).
- Feels like following a route on a map more than riding.

### C. The whole site is the map
One large painted city map. Scroll moves the camera across it, following the cab; at each stop it zooms into a painted scene.
- Most cinematic, heaviest to build and to load, highest risk on phones.


### D. Street + Sky (A and C mixed), proposed 2026-11-07 after owner asked
Two cameras, switched only twice, so it stays light on phones but has a cinematic peak.
- **Street camera (window seat):** for stops about places and people. The cab stays low on the screen, the street slides past sideways.
- **Sky camera (map):** for stops about the system. One painted map, never panned across a huge canvas: it only zooms in and out of a single square painting.
- **The lift:** the switch from street to sky. The street scene shrinks and fades while the map scales in from about 160% to 100%; the cab shrinks into a dot at the same spot on screen. **The drop** is the same in reverse, landing at the caller's door.

| Stop | Camera | What moves |
|---|---|---|
| 0 · Pickup | street | the cab pulls up at dusk |
| 1 · The call | street | drive to the townhouse, the phone rings in the window |
| lift | street to sky | the city falls away beneath, the cab becomes a dot |
| 2 · Zones | sky | washes bloom zone by zone, the ping drops on the caller |
| 3 · The clock | sky | the route draws from the cab to the pin; the four times sit along it as stations (2 s, instantly, 5 s, about 4 min) and the dot drives it |
| drop | sky to street | dive onto the caller's street |
| 4 · The garage | street | pass the small garage where it is being built (what exists today) |
| 5 · Your door | street | the cab stops, the driver waves, waitlist |
| End · Night | street | the cab drives off into the night |

**Phone:** the street is a 16:9 strip across the screen with the stop's text above it; the map is full width and square with text below; the lift and drop are the same scale + fade. Only transform and opacity, so it stays smooth.
**Build:** each ride is a pinned stage (`position: sticky`) about two screens tall, moved by CSS scroll-driven animations; no GSAP. Without support or with reduced motion: the stops stack as a normal page.
**Art needed:** 3 long street strips (dusk, residential street with garage, night) in two layers each, the map without washes (washes drawn in code or as a layer), cab with separate wheels.

## Anatomy of one transition (model A)
1. **Leaving a stop:** the frame's text slides out with the street (it belongs to the place), the cab pulls out (ease-in-out).
2. **The drive (about 1 screen of scroll):** layered street moves sideways; one small detail per drive (pigeons lift, a cafe light flicks on, rain on one stretch at night).
3. **Arriving:** scenery slows, cab dips once (braking), the stop's still frame rises into its Swiss grid modules (heading first, then lead, then painting), 60-90ms apart.
4. **At rest:** nothing moves except one small loop that belongs to the stop (phone ringing, ping on the map, clock ticking), only while it is on screen.

## Rules
- The still frames follow [[../style/swiss-editorial-rules]]: 12-column grid, 8px baseline, flush left, one big thing per frame.
- Text never moves while you are meant to read it.
- Reduced motion or no scroll-timeline support: the stops stack as a normal page with the paintings; no drive.
- Keyboard and screen readers get the stops as ordinary sections in order.
