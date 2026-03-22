# Nantis Fund Comparison Tool - Setup Guide

This guide will walk you through every single step to get the fund comparison
table working on your WordPress/Elementor website at nantis.ca.

**No coding knowledge needed.** Just follow the steps below.

---

## OVERVIEW - What You're Setting Up

You are connecting 3 things:

```
Google Sheet (your data) --> Widget Code --> Your WordPress Page
```

- **Google Sheet** = Where you type in fund data (like Excel, but online)
- **Widget Code** = The file `fund-comparison-widget.html` (already built for you)
- **WordPress Page** = Where visitors see the table on nantis.ca

Whenever you update the Google Sheet, the website table updates automatically.
No need to touch the website or the code again.

---

## STEP 1: Create Your Google Sheet

### 1A. Open Google Sheets
1. Go to https://sheets.google.com in your browser
2. Sign in with your Google account (if you don't have one, create a free one)
3. Click the **"+ Blank"** button to create a new spreadsheet

### 1B. Name your spreadsheet
1. Click on "Untitled spreadsheet" at the top-left
2. Type: **Nantis Fund Comparison Data**
3. Press Enter

### 1C. Set up your column headers
In Row 1, type exactly these headers (one per cell, starting from cell A1):

| Cell | Type This Exactly |
|------|-------------------|
| A1   | Fund Name         |
| B1   | Category          |
| C1   | Fund Manager      |
| D1   | % of NAV          |
| E1   | NAV ($)           |
| F1   | YTD Return (%)    |
| G1   | 1Y Return (%)     |
| H1   | 3Y Return (%)     |
| I1   | 5Y Return (%)     |
| J1   | MER (%)           |
| K1   | Risk Level        |
| L1   | Inception Date    |

**IMPORTANT:** The column headers must match EXACTLY (including spaces and
symbols). Copy-paste them if needed.

**ALTERNATIVE:** You can import the template file `google-sheet-template.csv`
into Google Sheets instead:
1. In Google Sheets, go to **File > Import**
2. Click **Upload** tab
3. Drag or select the `google-sheet-template.csv` file
4. Choose **Replace spreadsheet**
5. Click **Import data**

### 1D. Enter your fund data
Starting from Row 2, enter your fund data. Each row = one fund. Example:

| Fund Name | Category | Fund Manager | % of NAV | NAV ($) | YTD Return (%) | 1Y Return (%) | 3Y Return (%) | 5Y Return (%) | MER (%) | Risk Level | Inception Date |
|-----------|----------|-------------|----------|---------|----------------|----------------|----------------|----------------|---------|------------|----------------|
| ABC Growth Fund | Equity | ABC Capital | 12.45 | 25.67 | 8.30 | 15.20 | 42.10 | 78.50 | 1.85 | Medium-High | 2015-03-15 |

**Tips:**
- Enter numbers WITHOUT the % or $ signs (just the number, e.g., `12.45` not `12.45%`)
- If you don't have data for a column, just leave it blank
- Category suggestions: Equity, Balanced, Fixed Income, Alternative, Index, Real Estate, Money Market
- Risk Level suggestions: Low, Medium-Low, Medium, Medium-High, High

---

## STEP 2: Publish Your Google Sheet (Makes It Readable by the Website)

This step makes your Google Sheet data available to the website code. It does
NOT give anyone editing access - only reading access.

1. In your Google Sheet, click **File** (top menu)
2. Click **Share** > **Publish to the web**
3. A popup window appears
4. In the first dropdown, make sure **"Entire Document"** is selected
5. In the second dropdown, change it from "Web page" to **"Comma-separated values (.csv)"**
6. Click the green **"Publish"** button
7. Click **"OK"** on the confirmation popup
8. **COPY the link that appears** - it looks something like:
   ```
   https://docs.google.com/spreadsheets/d/e/2PACX-1vS.../pub?output=csv
   ```
9. **Save this link** - you'll need it in the next step

---

## STEP 3: Add the Link to the Widget Code

1. Open the file `fund-comparison-widget.html` in any text editor:
   - On Windows: Right-click the file > Open with > Notepad
   - On Mac: Right-click the file > Open with > TextEdit
2. Find this line (it's near the top of the JavaScript section):
   ```
   const GOOGLE_SHEET_CSV_URL = 'YOUR_GOOGLE_SHEET_CSV_URL_HERE';
   ```
3. Replace `YOUR_GOOGLE_SHEET_CSV_URL_HERE` with the link you copied in Step 2
4. It should now look like:
   ```
   const GOOGLE_SHEET_CSV_URL = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vS.../pub?output=csv';
   ```
5. **Save the file**

---

## STEP 4: Add the Widget to Your WordPress/Elementor Page

### 4A. Log into WordPress
1. Go to `https://www.nantis.ca/wp-admin` in your browser
2. Enter your WordPress username and password
3. Click **Log In**

### 4B. Open the page in Elementor
1. In the WordPress dashboard, go to **Pages** on the left sidebar
2. Find the page where you want the comparison table (or create a new page)
3. Click **Edit with Elementor**

### 4C. Add the Custom HTML widget
1. In the Elementor editor, click the **"+"** icon to add a new section, OR find
   where you want the table on your existing page
2. In the left panel, search for **"HTML"** in the widget search bar
3. Drag the **"Custom HTML"** widget to where you want the table on your page

### 4D. Paste the code
1. Click on the Custom HTML widget you just added
2. In the left panel, you'll see a big text area labeled "HTML Code"
3. Open the `fund-comparison-widget.html` file
4. Select ALL the text (Ctrl+A on Windows, Cmd+A on Mac)
5. Copy it (Ctrl+C / Cmd+C)
6. Paste it into the Elementor HTML Code text area (Ctrl+V / Cmd+V)

### 4E. Save and preview
1. Click the **"Update"** button (bottom of the Elementor panel) to save
2. Click the **eye icon** (preview) to see your live page
3. You should now see the fund comparison table!

---

## STEP 5: How to Update Your Data (Ongoing)

This is the process you'll repeat whenever you need to update fund data:

1. Open your Google Sheet at https://sheets.google.com
2. Edit the fund data (change numbers, add new funds, remove old ones)
3. **That's it!** The website will automatically pick up the changes within
   a few minutes (it refreshes every 5 minutes)

**To add a new fund:** Add a new row at the bottom of your sheet.
**To remove a fund:** Delete the entire row.
**To update a number:** Just click the cell and type the new number.

The table on your website automatically:
- Re-ranks funds by % of NAV (highest first)
- Updates all the numbers
- No need to touch WordPress at all

---

## CUSTOMIZING THE COLUMNS

The table comes with these default columns:

| Column | What It Shows |
|--------|---------------|
| Rank | Auto-calculated rank (1st, 2nd, 3rd...) based on % of NAV |
| Fund Name | Name of the fund |
| Category | Type of fund (Equity, Balanced, Fixed Income, etc.) |
| Fund Manager | Who manages the fund |
| % of NAV | The main ranking metric - Net Asset Value percentage |
| NAV ($) | Dollar value of the Net Asset Value |
| YTD Return (%) | Year-to-date return |
| 1Y Return (%) | 1-year return |
| 3Y Return (%) | 3-year return |
| 5Y Return (%) | 5-year return |
| MER (%) | Management Expense Ratio |
| Risk Level | Risk classification |
| Inception Date | When the fund started |

**Want to add or remove columns?** You'll need to edit the `COLUMNS` array in
the code. If you need help with this, just ask!

---

## FEATURES OF THE TABLE

- **Auto-ranking:** Funds are automatically ranked by % of NAV (highest = #1)
- **Sortable columns:** Click any column header to sort by that column
- **Search:** Type in the search box to find specific funds
- **Category filter:** Use the dropdown to show only certain fund categories
- **Color coding:** Positive numbers are green, negative numbers are red
- **Gold/Silver/Bronze:** Top 3 funds get special rank badges
- **Mobile friendly:** Table scrolls horizontally on phones
- **Auto-refresh:** Data refreshes from your Google Sheet every 5 minutes

---

## TROUBLESHOOTING

### The table shows "demo data" instead of my data
- Make sure you replaced `YOUR_GOOGLE_SHEET_CSV_URL_HERE` with your actual
  Google Sheet link (Step 3)
- Make sure you published the Google Sheet to the web (Step 2)

### The table shows an error
- Check that your Google Sheet link ends with `?output=csv`
- Make sure the sheet is published (Step 2, step 6)
- Try opening the CSV link directly in your browser - you should see your data

### Numbers look wrong
- Make sure you entered numbers WITHOUT % or $ signs in the Google Sheet
- Use a period (.) for decimals, not a comma

### Columns are missing or empty
- Check that your Google Sheet column headers match EXACTLY what's listed in
  Step 1C (including spaces and capitalization)

---

## NEED MORE HELP?

If anything is unclear or you need changes to the tool, just describe what you
need and I can help!
