# Copy deck (placeholder, Claude draft)

> History: how the idea developed. The demo (`design/ride-test/`) replaced this where they differ.

> Status: placeholder 2026-11-07, drafted by Claude from the real Voronoi Taxi project (seminar paper + public repo). **Owner writes or approves the final English.** Drafted against the voice rules in the author's voice notes: short, direct, results as the subject, no feature tours, the first line under a heading never repeats the heading.
>
> Limits per the Swiss rules: headings ≤ 2 lines (about 32 characters), one lead sentence, body ≤ 60 words per stop.

## Real facts this copy may use
- The original: a seminar paper and a Python prototype, January 2026, open on GitHub (`github.com/Rudic21302/VoronojTaxi`).
- Idea: a Voronoi diagram splits the city so each cab owns the area closer to it than to any other cab ("the post office problem" from computational geometry). A call is answered by looking up which zone it falls in, instead of measuring the distance to every cab.
- Build: the diagram via a plane-sweep (Fortune's) algorithm, O(n log n); a KD-tree finds the nearest cab for all callers in one query; NumPy and SciPy; a fixed random seed so every run is repeatable.
- Simulation: a 10 × 10 grid, 24 cabs, 12 callers (seed 35), drawn over a map of Subotica; five simulations with different counts; each assignment takes a few milliseconds.
- Edge cases solved: open zones at the city edge closed into polygons; zones clipped to the map (Sutherland-Hodgman).
- Finding: the nearest cab is not always a free cab. The model sent one cab to several callers at once ("multiple assignment").
- Missing for real use (from the paper's conclusion): a queue, live cab status, real road distances instead of straight lines, time of day and traffic, a maps service.

---

## Stop 0 · Pickup (street, dusk)
Reader question: What is this?
- **Display heading:** The nearest [cab] answers.
- **Lead:** A dispatch system that splits your city into zones, one per free cab, so every call goes to the car closest to the door.
- **Button:** Join the waitlist
- **Caption (under the street):** Every cab on the street owns the blocks nearest to it.

## Stop 1 · The call (street, townhouse)
Reader question: Why does it matter?
- **Rule label:** Stop 1 · The call
- **Heading:** A phone rings. 24 cabs are free.
- **Lead:** The dispatcher has seconds to pick one.
- **Body:** The usual answer is a radio round: ask who is close, wait, guess. The wrong guess costs a cab driving empty across town and a caller watching the clock. Every empty kilometre is money nobody sees.
- **Caption:** One caller, one lit window, many possible cabs.

## Lift (street to sky)
No copy. The city falls away; the cab becomes a dot.

## Stop 2 · Zones (sky, map)
Reader question: How does it work?
- **Rule label:** Stop 2 · Above the city
- **Heading:** Every cab owns a patch of the city
- **Lead:** Each zone holds the streets closer to its cab than to any other.
- **Body:** A call is answered by finding the zone it falls in, not by measuring the distance to every car. Geometry calls this the post office problem. The zones redraw whenever a cab moves.
- **Caption:** Seven cabs, seven zones. The red pin is the caller.
  - Note for owner: "redraw whenever a cab moves" is the product vision; the prototype is static. Keep or cut.

## Stop 3 · The clock (sky, route)
Reader question: How fast is it?
- **Rule label:** Stop 3 · The clock
- **Heading:** From call to curb
- **Lead:** The slow part is the drive. Everything before it takes seconds.
- **Stations on the route:**
  - **2 seconds** · the call and the address are logged
  - **Instantly** · the address lands in one zone
  - **5 seconds** · that zone's driver accepts
  - **About 4 minutes** · the cab takes the short way to the door
- **Caption:** In the prototype, each assignment takes a few milliseconds.
  - Note for owner: 2 s / 5 s / 4 min are illustrative targets, not measured. The milliseconds are measured.

## Drop (sky to street)
No copy. Down onto the caller's street.

## Stop 4 · The garage (street)
Reader question: Can I trust it?
- **Rule label:** Stop 4 · The garage
- **Heading:** What exists today
- **Lead:** A working prototype, built in Python in January 2026 and open to read.
- **Built:**
  - **The zone map.** 24 cabs and 12 callers over a real city map, zones closed and clipped to its edges.
  - **The nearest-cab search.** One query finds the closest cab for every caller at once.
- **Next:**
  - **A queue.** The prototype can send one cab to two callers. A queue fixes that first.
- **Later:**
  - **Real roads and real time.** Live cab status, street distances, traffic by hour, a maps service.
- **Link:** Read how the prototype works (to the GitHub repo)

## Stop 5 · Your door (street, yellow)
Reader question: What do I do next?
- **Sentence-form:** Tell me when it runs: [your email] Okay.
- **Honest note:** NearCab isn't software yet. Connect this form to your own mailing list before you publish it.
- **After sending:** You're on the list. The next stop is your inbox.

## End · Night (street, night)
Reader question: Who made this?
- **Display line:** NearCab
- **Notes:** NearCab is a design study for a product that does not exist yet. · Based on the Voronoi Taxi prototype, 2026.
- **Fine print:** Design mockup. The software is not built. · Paintings made with an image model, art-directed by hand. · 2026
