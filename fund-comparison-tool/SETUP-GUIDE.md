# Nantis Fund Comparison Tool - Setup Guide

This guide will walk you through every single step to get the fund comparison
table working on your WordPress/Elementor website at nantis.ca.

**No coding knowledge needed.** Just follow the steps below.

---

## OVERVIEW - What You're Setting Up

You are connecting 3 things:

```
Excel Spreadsheet (your data) --> Widget Code --> Your WordPress Page
```

- **Excel Online (OneDrive)** = Where you type in fund data, just like regular Excel
- **Widget Code** = The file `fund-comparison-widget.html` (already built for you)
- **WordPress Page** = Where visitors see the table on nantis.ca

Whenever you update the Excel spreadsheet, the website table updates automatically.
No need to touch the website or the code again.

**You have 2 options for your spreadsheet:**
- **Option A: Excel Online (OneDrive)** - RECOMMENDED - edit in Excel, website updates automatically
- **Option B: Google Sheets** - same idea, but using Google instead of Microsoft

Pick ONE option below and follow those steps.

---

# OPTION A: USING EXCEL ONLINE (OneDrive) — RECOMMENDED

## STEP A1: Create Your Excel File on OneDrive

### A1a. Go to OneDrive
1. Open your browser and go to https://onedrive.live.com
2. Sign in with your Microsoft account (the same one you use for Outlook, Office, etc.)
3. If you don't have a Microsoft account, create a free one at https://signup.live.com

### A1b. Create a new Excel workbook
1. Click the **"+ New"** button (top-left area)
2. Click **"Excel workbook"**
3. A new Excel spreadsheet opens in your browser — this works just like regular Excel

### A1c. Name your file
1. Click on "Book" (or "Workbook") at the top of the page
2. Type: **Nantis Fund Data**
3. Press Enter

### A1d. Set up your column headers
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
symbols). You can copy-paste them from here.

**SHORTCUT:** Instead of typing headers manually, you can import the template:
1. Open the file `google-sheet-template.csv` on your computer (it works for Excel too)
2. Select all, copy
3. Paste into cell A1 of your Excel Online spreadsheet

### A1e. Enter your fund data
Starting from Row 2, enter your fund data. Each row = one fund.

**Tips:**
- Enter numbers WITHOUT the % or $ signs (just the number, e.g., `12.45` not `12.45%`)
- If you don't have data for a column, just leave it blank
- Category suggestions: Equity, Balanced, Fixed Income, Alternative, Index, Real Estate, Money Market
- Risk Level suggestions: Low, Medium-Low, Medium, Medium-High, High

---

## STEP A2: Share Your Excel File (Get the Download Link)

This step creates a link that lets the website read your data. It does NOT give
anyone editing access — only reading access.

### Method: Create a sharing link

1. In your Excel Online file, click the **"Share"** button (top-right corner)
2. Click **"Copy link"** (or "Anyone with the link can view")
3. Make sure it's set to **"Anyone with the link"** and **"Can view"** (NOT "Can edit")
4. Click **"Copy"**
5. You'll get a link that looks something like:
   ```
   https://1drv.ms/x/s!AbCdEfGhIjKlMnOp
   ```

### Convert the sharing link to a direct download link

The sharing link won't work directly — we need to convert it to a download link.
Here's how:

1. Go to this free tool in your browser: https://onedrive.live.com
2. Find your **Nantis Fund Data** file
3. Right-click on the file
4. Click **"Embed"**
5. Click **"Generate"**
6. You'll see an embed code. Look for the URL inside it — it contains something like:
   ```
   https://onedrive.live.com/embed?resid=XXXXX&authkey=XXXXX
   ```
7. Take that URL and change `/embed?` to `/download?` so it becomes:
   ```
   https://onedrive.live.com/download?resid=XXXXX&authkey=XXXXX
   ```

**EASIER ALTERNATIVE:** If the above seems complicated, you can:
1. In Excel Online, go to **File > Save As > Download a Copy**
2. This downloads a `.xlsx` file to your computer
3. Open it in Excel on your computer
4. **File > Save As** > Choose **CSV (Comma delimited) (*.csv)**
5. Upload this `.csv` file to your WordPress Media Library
   (WordPress Dashboard > Media > Add New > Upload)
6. After uploading, click on the file and copy its **URL**
   (it will look like `https://www.nantis.ca/wp-content/uploads/2026/03/nantis-fund-data.csv`)
7. Use THIS URL in Step A3 below
8. **NOTE:** With this method, you'll need to re-upload the CSV each time you
   update data. It's simpler to set up but requires a manual upload step.

---

## STEP A3: Add the Link to the Widget Code

1. Open the file `fund-comparison-widget.html` in any text editor:
   - On Windows: Right-click the file > Open with > Notepad
   - On Mac: Right-click the file > Open with > TextEdit
2. Find this line (it's near the top of the JavaScript section):
   ```
   const DATA_CSV_URL = 'YOUR_SPREADSHEET_CSV_URL_HERE';
   ```
3. Replace `YOUR_SPREADSHEET_CSV_URL_HERE` with the link you got in Step A2
4. It should now look like:
   ```
   const DATA_CSV_URL = 'https://www.nantis.ca/wp-content/uploads/2026/03/nantis-fund-data.csv';
   ```
   or:
   ```
   const DATA_CSV_URL = 'https://onedrive.live.com/download?resid=XXXXX&authkey=XXXXX';
   ```
5. **Save the file**

---

# OPTION B: USING GOOGLE SHEETS (Alternative)

If you prefer Google Sheets over Excel, follow these steps instead.

## STEP B1: Create Your Google Sheet

1. Go to https://sheets.google.com in your browser
2. Sign in with your Google account
3. Click **"+ Blank"** to create a new spreadsheet
4. Name it **Nantis Fund Data**
5. Set up the same column headers as listed in Step A1d above
6. Enter your fund data starting from Row 2

## STEP B2: Publish Your Google Sheet

1. Click **File** (top menu)
2. Click **Share** > **Publish to the web**
3. In the first dropdown, select **"Entire Document"**
4. In the second dropdown, change to **"Comma-separated values (.csv)"**
5. Click **"Publish"**
6. Click **"OK"** to confirm
7. **Copy the link** that appears (looks like `https://docs.google.com/spreadsheets/d/e/2PACX-.../pub?output=csv`)

## STEP B3: Add the Link to the Widget Code

Same as Step A3 above — replace `YOUR_SPREADSHEET_CSV_URL_HERE` with your
Google Sheets link.

---

# STEP 4: Add the Widget to Your WordPress/Elementor Page

(This step is the same regardless of whether you chose Excel or Google Sheets.)

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
3. Open the `fund-comparison-widget.html` file in Notepad/TextEdit
4. Select ALL the text (Ctrl+A on Windows, Cmd+A on Mac)
5. Copy it (Ctrl+C / Cmd+C)
6. Paste it into the Elementor HTML Code text area (Ctrl+V / Cmd+V)

### 4E. Save and preview
1. Click the **"Update"** button (bottom of the Elementor panel) to save
2. Click the **eye icon** (preview) to see your live page
3. You should now see the fund comparison table!

---

## STEP 5: How to Update Your Data (Ongoing)

### If using Excel Online (OneDrive) with direct download link:
1. Open your Excel file on OneDrive (https://onedrive.live.com)
2. Edit the fund data
3. Done! The website refreshes automatically every 5 minutes.

### If using the CSV upload method:
1. Open your Excel file on your computer
2. Edit the data
3. Save As > CSV
4. Go to WordPress Dashboard > Media
5. Delete the old CSV file and upload the new one
   (or upload with the same filename to replace it)

### If using Google Sheets:
1. Open your Google Sheet
2. Edit the data
3. Done! Auto-updates within a few minutes.

---

## CUSTOMIZING THE COLUMNS

The table comes with these default columns:

| Column | What It Shows |
|--------|---------------|
| Rank | Auto-calculated (1st, 2nd, 3rd...) based on % of NAV |
| Fund Name | Name of the fund |
| Category | Type of fund (Equity, Balanced, Fixed Income, etc.) |
| Fund Manager | Who manages the fund |
| % of NAV | The main ranking metric — Net Asset Value percentage |
| NAV ($) | Dollar value of the Net Asset Value |
| YTD Return (%) | Year-to-date return |
| 1Y Return (%) | 1-year return |
| 3Y Return (%) | 3-year return |
| 5Y Return (%) | 5-year return |
| MER (%) | Management Expense Ratio |
| Risk Level | Risk classification |
| Inception Date | When the fund started |

**Want to add, remove, or rename columns?** Just let me know!

---

## FEATURES OF THE TABLE

- **Auto-ranking:** Funds are automatically ranked by % of NAV (highest = #1)
- **Sortable columns:** Click any column header to sort by that column
- **Search:** Type in the search box to find specific funds
- **Category filter:** Use the dropdown to show only certain fund categories
- **Color coding:** Positive numbers are green, negative numbers are red
- **Gold/Silver/Bronze:** Top 3 funds get special rank badges
- **Mobile friendly:** Table scrolls horizontally on phones
- **Auto-refresh:** Data refreshes from your spreadsheet every 5 minutes

---

## TROUBLESHOOTING

### The table shows "demo data" instead of my data
- Make sure you replaced `YOUR_SPREADSHEET_CSV_URL_HERE` with your actual link (Step A3 or B3)
- Make sure the spreadsheet is shared/published

### The table shows an error
- Try opening your CSV link directly in your browser — you should see your data as text
- For Excel Online: make sure the link is a download link, not a sharing link
- For Google Sheets: make sure the link ends with `?output=csv`

### Numbers look wrong
- Make sure you entered numbers WITHOUT % or $ signs in the spreadsheet
- Use a period (.) for decimals, not a comma

### Columns are missing or empty
- Check that your column headers match EXACTLY what's listed in Step A1d
  (including spaces and capitalization)

---

## MY RECOMMENDATION

The **simplest approach** for someone who prefers Excel:

1. Keep your Excel file on your computer
2. When you update it, save a copy as CSV
3. Upload the CSV to WordPress Media Library
4. The table reads from that uploaded file

This takes about 30 seconds each time you update, and you get to use regular
Excel on your desktop — no cloud accounts needed.

---

## NEED MORE HELP?

If anything is unclear or you need changes to the tool, just describe what you
need and I can help!
