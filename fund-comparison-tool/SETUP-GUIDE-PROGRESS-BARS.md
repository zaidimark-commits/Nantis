# Nantis Class A / Class F Progress Bars - Setup Guide

This guide will walk you through every single step to get the Class A / Class F
progress bars working on your WordPress/Elementor website at nantis.ca.

**No coding knowledge needed.** Just follow the steps below.

---

## OVERVIEW - What You're Setting Up

You are connecting 3 things:

```
Google Sheet (2 numbers) --> Widget Code --> Your WordPress Page
```

- **Google Sheet / CSV** = Where you type in just 2 numbers
- **Widget Code** = The HTML files (already built for you)
- **WordPress Pages** = Where visitors see the progress bars

**You have 2 widget files:**
- `progress-bars-widget.html` — **English** version (for www.nantis.ca)
- `progress-bars-widget-fr.html` — **French** version (for www.nantis.ca/fr)

Both read from the **same spreadsheet** (same data, same CSV URL). The French
version shows French labels.

---

## WHAT THE WIDGET DOES

The widget shows **2 horizontal progress bars** — one for Class A and one for Class F.

**Inside each bar:**
- **Left side** = Dollar value (e.g., `$107.14`)
- **Right side** = Percentage (e.g., `107.14%`)

**The math is automatic:**
- **Class A %** = Money Raised ÷ Current Net Value × 100
- **Class F %** = Class A × 0.9475

**Overperformance (above 100%):**
- The bar fills completely at 100%
- A glowing green **+X.XX%** badge appears next to the bar
- Example: if Class A = 107.14%, the bar is full and shows **+7.14%**

**Under 100%:**
- The bar fills proportionally (e.g., 85% = bar fills 85% of the way)
- No overperformance badge

---

## YOUR SPREADSHEET — ONLY 2 NUMBERS

This is the simplest possible setup. Your spreadsheet needs just **one row of data**:

| Column | What to Enter | Example |
|--------|---------------|---------|
| Money Raised | Total money raised ($) | 10500000 |
| Current Net Value | Current net value of the portfolio ($) | 9800000 |

**That's it.** The widget calculates everything else.

A template file `progress-bars-data-template.csv` is included — you can
import it into Google Sheets or Excel to get started.

**IMPORTANT:** Enter numbers WITHOUT $ signs or commas. Just the raw number
(e.g., `10500000` not `$10,500,000`).

---

## STEP 1: Set Up Your Data (Pick ONE Option)

### Option A: Google Sheets (Recommended — Auto-updates)

1. Go to https://sheets.google.com
2. Create a new spreadsheet named **Nantis Progress Data**
3. In cell **A1** type: `Money Raised`
4. In cell **B1** type: `Current Net Value`
5. In cell **A2** type your money raised number (e.g., `10500000`)
6. In cell **B2** type your current net value (e.g., `9800000`)
7. Go to **File** > **Share** > **Publish to the web**
8. Choose **Comma-separated values (.csv)** format
9. Click **Publish**
10. Copy the link — it will look like:
    `https://docs.google.com/spreadsheets/d/e/XXXX/pub?output=csv`

**To update:** Just change the 2 numbers in cells A2 and B2. The website
updates automatically within a few minutes.

### Option B: Excel on your computer (Manual upload)

1. Open `progress-bars-data-template.csv` in Excel
2. Replace the example numbers with your real data
3. Save As > **CSV (Comma delimited) (*.csv)**
4. Upload the CSV file to WordPress:
   - WordPress Dashboard > **Media** > **Add New** > Upload the file
   - After uploading, click on the file and **copy the URL**
5. When you update: edit in Excel, re-save as CSV, re-upload to WordPress

### Option C: Excel Online (OneDrive)

1. Go to https://onedrive.live.com and sign in
2. Click **+ New** > **Excel workbook**
3. Name it **Nantis Progress Data**
4. Set up headers in A1 and B1, data in A2 and B2 (same as Google Sheets above)
5. Download as CSV and upload to WordPress Media

---

## STEP 2: Add the URL to Both Widget Files

You need to do this for **both** the English and French widget files.

### For the English version:
1. Open `progress-bars-widget.html` in Notepad (or any text editor)
2. Find this line near the top:
   ```
   const PW_DATA_URL = 'YOUR_SPREADSHEET_CSV_URL_HERE';
   ```
3. Replace `YOUR_SPREADSHEET_CSV_URL_HERE` with your CSV URL
4. Save the file

### For the French version:
1. Open `progress-bars-widget-fr.html` in Notepad
2. Find the same line and replace the URL (use the **same URL** as the English one)
3. Save the file

**Both widgets read from the same spreadsheet.** You only maintain one set of data.

---

## STEP 3: Add the English Widget to nantis.ca

1. Go to `https://www.nantis.ca/wp-admin` and log in
2. Go to **Pages** > find the page where you want the progress bars
3. Click **Edit with Elementor**
4. Search for the **"Custom HTML"** widget in the left panel
5. Drag it where you want the progress bars
6. Open `progress-bars-widget.html` in Notepad, Select All (Ctrl+A), Copy (Ctrl+C)
7. Paste into the Elementor HTML Code text area
8. Click **Update** to save

---

## STEP 4: Add the French Widget to nantis.ca/fr

1. In WordPress, go to **Pages** > find your French page
2. Click **Edit with Elementor**
3. Add a **"Custom HTML"** widget
4. Open `progress-bars-widget-fr.html` in Notepad, Select All, Copy
5. Paste into the HTML Code text area
6. Click **Update**

---

## STEP 5: Updating Your Data (Ongoing)

### If using Google Sheets (Option A — recommended):
1. Open your Google Sheet
2. Change the number in cell **A2** (Money Raised) or **B2** (Current Net Value)
3. Done — both pages update automatically within minutes

### If using CSV upload to WordPress (Option B):
1. Edit your Excel file
2. Save As CSV
3. Go to WordPress Dashboard > Media
4. Upload the new CSV (same filename replaces the old one)
5. Both pages update automatically

---

## HOW THE FORMULAS WORK

### Class A Calculation
```
Class A % = Money Raised ÷ Current Net Value × 100
```
**Example:** $10,500,000 ÷ $9,800,000 × 100 = **107.14%**

This means: for every $100 invested, the current value is **$107.14**

### Class F Calculation
```
Class F % = Class A % × 0.9475
```
**Example:** 107.14% × 0.9475 = **101.52%**

This means: for every $100 invested (Class F), the current value is **$101.52**

### Dollar Values Shown
The dollar values displayed in the bars represent the **value per $100 invested**:
- Class A shows **$107.14** (meaning $100 invested is now worth $107.14)
- Class F shows **$101.52** (meaning $100 invested is now worth $101.52)

---

## HOW THE PROGRESS BARS WORK

### Bar at 0% to 100%
- The bar fills proportionally
- 50% = bar fills halfway
- 85% = bar fills 85% of the width
- Dollar value on the left, percentage on the right

### Bar at exactly 100%
- The bar is completely full
- No overperformance badge shown
- This means $100 invested = $100 current value (break even)

### Bar above 100% (overperformance)
- The bar is completely full with a subtle glow effect
- A green **+X.XX%** badge appears to the right of the bar
- The badge gently pulses to draw attention
- Example: 107.14% → full bar + glowing **+7.14%** badge

### Visual Design
- **Class A bar** = Teal gradient (matches Nantis brand)
- **Class F bar** = Blue gradient
- Scale markers at 0%, 25%, 50%, 75%, 100% below each bar
- Dark navy background matching nantis.ca theme

---

## EXAMPLE SCENARIOS

### Scenario 1: Fund is performing well
- Money Raised: $10,500,000
- Current Net Value: $9,800,000
- **Class A: 107.14%** → $107.14 → full bar + **+7.14%** badge
- **Class F: 101.52%** → $101.52 → full bar + **+1.52%** badge

### Scenario 2: Fund is at break even
- Money Raised: $10,000,000
- Current Net Value: $10,000,000
- **Class A: 100.00%** → $100.00 → full bar, no badge
- **Class F: 94.75%** → $94.75 → bar fills 94.75%

### Scenario 3: Fund is below par
- Money Raised: $8,500,000
- Current Net Value: $10,000,000
- **Class A: 85.00%** → $85.00 → bar fills 85%
- **Class F: 80.54%** → $80.54 → bar fills 80.54%

---

## TROUBLESHOOTING

### Bars show "demo data"
- Make sure you replaced `YOUR_SPREADSHEET_CSV_URL_HERE` with your actual URL

### Values seem wrong
- Check that your spreadsheet has the correct column headers: `Money Raised` and `Current Net Value`
- Make sure numbers don't have $ or , characters — just plain numbers

### Widget shows error message
- Verify the spreadsheet URL is correct
- If using Google Sheets, make sure it's published to the web (File > Share > Publish)
- If using WordPress upload, make sure the CSV file URL is accessible

### Class F seems low compared to Class A
- This is correct — Class F is always Class A × 0.9475 (94.75% of Class A)
- The 0.9475 factor accounts for the different fee structure

---

## NEED HELP?

If anything is unclear or you need changes, just ask!
